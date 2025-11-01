<?php
session_start();
include("supplier_header.php"); // Includes connection and basic styling
include("connect.php");

// Security check: Ensure supplier is logged in
if (!isset($_SESSION["sid"])) {
    echo "<script>alert('Please log in as a Supplier to view this report.'); window.location.href='login.php';</script>";
    exit();
}

$suppid = $_SESSION["sid"];
?>


<style>
/* Reusing styling from other report files for consistency */
html, body {
  height: 100%;
  margin: 0;
}

body {
  display: flex;
  flex-direction: column;
  min-height: 100vh; 
}

.page-content {
  flex: 1; 
}

.custom-table {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  background: white;
  margin-top: 20px;
}
.custom-table th {
  background-color: #212121;
  color: white;
  padding: 12px;
  text-align: center;
  font-size: 16px;
}
.custom-table td {
  padding: 12px;
  text-align: center;
  font-size: 15px;
  color: #333;
}
.custom-table tr:nth-child(even) {
  background-color: #f8f9fa;
}
.custom-table tr:hover {
  background-color: #e3e3e3;
  transition: 0.3s;
}
</style>

<div class="page-content"> 
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center mt-3 text-dark">
        <h1>Supplier Bill Report</h1>
        <p class="text-secondary">Orders containing products supplied by Supplier ID: <?php echo $suppid; ?></p>
      </div>
    </div>

    <?php
    // Query to find unique orders (Cart IDs) that contain at least one perfume supplied by this supplier.
    // We use DISTINCT to prevent showing the same order multiple times if it contains multiple products from the same supplier.
    $query = "SELECT DISTINCT
                od.order_id,          /* Index 0: Order ID */
                od.order_date,        /* Index 1: Order Date */
                od.cart_id,           /* Index 2: Cart ID */
                cdet.customer_name,   /* Index 3: Customer Name */
                od.order_address,     /* Index 4: Order Address */
                od.order_mobile,      /* Index 5: Order Mobile */
                od.order_amount       /* Index 6: Order Amount */
              FROM
                order_detail od
              JOIN
                customer_detail cdet ON od.customer_id = cdet.customer_id
              JOIN
                cart_detail c ON od.cart_id = c.cart_id
              JOIN
                perfume_detail p ON c.perfume_id = p.perfume_id
              WHERE
                p.supplier_id = '$suppid'
              ORDER BY
                od.order_date DESC";

    $res = mysqli_query($con, $query);

    if(mysqli_num_rows($res) > 0) 
    {
        echo "<table class='custom-table'>";
        echo "<tr>
        <th>Order ID</th>
        <th>Order Date</th>
        <th>Customer Name</th>
        <th>Order Address</th>
        <th>Order Mobile No</th>
        <th>Order Total Amount (Cart Total)</th>
        <th>View Details</th>
        </tr>";

        while ($r = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>$r[0]</td>"; // order_id
            echo "<td>$r[1]</td>"; // order_date
            echo "<td>$r[3]</td>"; // Customer Name (FIXED index from $r[2] to $r[3])
            echo "<td>$r[4]</td>"; // order_address
            echo "<td>$r[5]</td>"; // order_mobile
            echo "<td>&#8377; $r[6] /-</td>"; // order_amount
            // Link to view the detailed cart items (uses cust_view_order_detail.php, passing cart_id $r[2])
            echo "<td><a href='cust_view_order_detail.php?cid=$r[2]' class='btn-action btn-edit'>View Items</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } 
    else 
    {
        echo '<p class="text-center mt-5">No orders found containing your supplied products.</p>';
    }
    ?>
  </div>
</div>

<?php
include("footer.php"); // Includes closing tags and scripts
?>
