<?php
session_start();
include("header.php"); // Includes connection and basic styling
include("connect.php"); // Defines $con

// --- Security Check ---
// The user MUST be logged in as a customer to view their invoice
if (!isset($_SESSION["custid"])) {
    // Using header redirection instead of script for robustness, although script is commonly used in your existing files
    echo "<script>alert('Please log in to view invoices.'); window.location.href='login.php';</script>";
    exit();
}

// Ensure the cart ID (cid) is provided
if (!isset($_REQUEST["cid"])) {
    echo "<script>alert('Invalid Order Request. Missing Cart ID.'); window.location.href='cust_view_orders.php';</script>";
    exit();
}

// Use mysqli_real_escape_string for basic security improvement
$cartid = mysqli_real_escape_string($con, $_REQUEST["cid"]);
$custid_session = $_SESSION["custid"];

// 1. Fetch Order Details (from order_detail using cart_id)
// Array mapping: 0=order_id, 1=order_date, 3=customer_id, 4=order_address, 5=order_mobile, 6=order_amount
$order_sql = "SELECT order_id, order_date, customer_id, order_address, order_mobile, order_amount FROM order_detail WHERE cart_id = '$cartid'";
$order_res = mysqli_query($con, $order_sql);

if(mysqli_num_rows($order_res) == 0) {
    echo "<script>alert('Order not found or no order associated with this cart.'); window.location.href='cust_view_orders.php';</script>";
    exit();
}

// Fetch data as an associative array for clarity
$order_data = mysqli_fetch_assoc($order_res);
$order_id = $order_data['order_id'];
$order_date = $order_data['order_date'];
$custid_db = $order_data['customer_id'];
$delivery_address = $order_data['order_address'];
$delivery_mno = $order_data['order_mobile'];
$total_amount = $order_data['order_amount'];

// Double-check if the order belongs to the logged-in user (essential security layer)
if ($custid_db != $custid_session) {
    echo "<script>alert('Access Denied: This invoice does not belong to your account.'); window.location.href='cust_view_orders.php';</script>";
    exit();
}

// 2. Fetch Customer Details (Name, Email)
$customer_sql = "SELECT customer_name, customer_email FROM customer_detail WHERE customer_id = '$custid_db'";
$customer_res = mysqli_query($con, $customer_sql);
$customer_data = mysqli_fetch_assoc($customer_res);
$customer_name = $customer_data['customer_name'];
$customer_email = $customer_data['customer_email'];

// 3. Fetch Line Items (Products in the Cart)
// We join cart_detail with perfume_detail to get the perfume name, but use cart_price and cart_quantity
$items_sql = "SELECT cd.cart_quantity, cd.cart_price, pd.perfume_name 
              FROM cart_detail cd 
              JOIN perfume_detail pd ON cd.perfume_id = pd.perfume_id 
              WHERE cd.cart_id = '$cartid'";
$items_res = mysqli_query($con, $items_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #<?php echo $order_id; ?> - Perfume Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to basic styles (assuming header.php usually links this, but including it here for standalone clarity) -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"> 
    
    <!-- Load custom styles for a clean, professional, and print-ready invoice -->
    <style>
        /* General Invoice Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f8f9fa;
        }
        .invoice-box {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 14px;
            line-height: 24px;
            background-color: white;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            color: #212121;
            font-size: 32px;
            font-weight: bold;
        }
        .invoice-header .logo {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: bold;
            color: #f9c74f;
            letter-spacing: 1px;
        }
        /* Table Styling */
        .invoice-table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .invoice-table th {
            background-color: #212121;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 16px;
        }
        .invoice-table td {
            text-align: center;
            vertical-align: top;
            font-size: 15px;
        }
        .invoice-table td:nth-child(2) {
            text-align: left; /* Align product name left */
        }
        .total-row td {
            border-top: 2px solid #212121;
            font-size: 18px;
            font-weight: bold;
        }
        .footer-note {
            margin-top: 30px;
            text-align: center;
            font-style: italic;
            color: #6c757d;
        }
        /* Print Styles */
        @media print {
            body {
                background-color: white;
            }
            .invoice-box {
                box-shadow: none;
                margin: 0;
                border: none;
            }
            .no-print {
                display: none;
            }
        }
        /* Print Button Styling */
        .btn-print {
            background-color: #212121;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            border: none;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        .btn-print:hover {
             background-color: #444;
        }
    </style>
    <!-- Font Awesome for print icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="invoice-box">
    <div class="invoice-header">
        <div>
            <span class="logo">PerfumeShop.com</span>
            <br>
           
        </div>
        <h1>INVOICE</h1>
    </div>

    <!-- Billing and Shipping Information -->
    <table cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px;">
        <tr>
            <td style="width: 50%;">
                Billed To:  <br>
                <?php echo htmlspecialchars($customer_name); ?><br>
                <?php echo htmlspecialchars($customer_email); ?>
            </td>
            <td style="width: 50%; text-align: right;">
                Ship To:  <br>
                <?php echo nl2br(htmlspecialchars($delivery_address)); ?><br>
                Mobile: <?php echo htmlspecialchars($delivery_mno); ?>
            </td>
        </tr>
    </table>

    <!-- Invoice Details (Number, Date) -->
    <table cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 30px;">
        <tr>
            <td style="width: 50%;">
                Invoice #: <?php echo $order_id; ?><br>
                Order Date: <?php echo date("F j, Y", strtotime($order_date)); ?>
            </td>
            <td style="width: 50%; text-align: right;">
                Cart ID: <?php echo $cartid; ?><br>
                Customer ID: <?php echo $custid_db; ?>
            </td>
        </tr>
    </table>

    <!-- Line Items Table -->
    <table class="invoice-table">
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 50%; text-align: left;">Product (Perfume Name)</th>
                <th style="width: 15%;">Quantity</th>
                <th style="width: 15%;">Unit Price</th>
                <th style="width: 15%;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $subtotal = 0;
            // Iterate through all items associated with this cart ID
            while($item = mysqli_fetch_assoc($items_res)) {
                $item_qty = $item['cart_quantity'];
                $item_price = $item['cart_price'];
                $item_name = $item['perfume_name'];
                $item_amount = $item_qty * $item_price;
                $subtotal += $item_amount;
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td style="text-align: left;"><?php echo htmlspecialchars($item_name); ?></td>
                <td><?php echo $item_qty; ?></td>
                <td>&#8377; <?php echo number_format($item_price, 2); ?></td>
                <td>&#8377; <?php echo number_format($item_amount, 2); ?></td>
            </tr>
            <?php
            }
            
            // Final total logic
            $grand_total = $total_amount;
            if (abs($subtotal - $total_amount) > 0.01) {
                // Warning if line items don't match stored total
                echo '<tr><td colspan="5" class="text-danger" style="text-align: center;">**Warning: Calculated item total does not match stored Order Amount!**</td></tr>';
            }
            ?>

            <tr class="total-row">
                <td colspan="4" style="text-align: right; border-bottom: none;">Total Amount (Paid)</td>
                <td style="border-bottom: none;">&#8377; <?php echo number_format($grand_total, 2); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="footer-note">
        Thank you for shopping with PerfumeShop.com! All sales are final.
    </div>
</div>



<!-- Includes footer.php for closing tags and scripts if needed -->
<?php
include("footer.php");
?>
