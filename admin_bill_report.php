<?php
include("admin_header.php"); // Includes connection and sets up admin navigation
include("connect.php");
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
.btn-action {
  padding: 6px 12px;
  font-size: 14px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  text-decoration: none;
  color: white;
}
.btn-edit {
  background-color: #4CAF50;
}
.btn-edit:hover {
  background-color: #45a049;
}
</style>

<div class="page-content"> 
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center mt-3 text-dark">
        <h1>Admin Bill Report (All Orders)</h1>
      </div>
    </div>

    <?php
    // Query to fetch all orders along with the corresponding customer name
    $query = "SELECT 
                od.order_id,            /* Index 0: Order ID */
                od.order_date,          /* Index 1: Order Date */
                cdet.customer_name,     /* Index 2: Customer Name */
                od.order_address,       /* Index 3: Order Address */
                od.order_mobile,        /* Index 4: Order Mobile */
                od.order_amount,        /* Index 5: Order Amount */
                od.cart_id              /* Index 6: Cart ID (Used for invoice link) */
              FROM
                order_detail od
              JOIN
                customer_detail cdet ON od.customer_id = cdet.customer_id
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
        <th>Address</th>
        <th>Mobile No</th>
        <th>Amount</th>
        
        </tr>";

        while ($r = mysqli_fetch_array($res)) {
            // Note: Array indices map directly to the order in the SELECT query above.
            echo "<tr>";
            echo "<td>$r[0]</td>"; // Order ID
            echo "<td>$r[1]</td>"; // Order Date
            echo "<td>$r[2]</td>"; // Customer Name
            echo "<td>$r[3]</td>"; // Address
            echo "<td>$r[4]</td>"; // Mobile No
            echo "<td>&#8377; $r[5] /-</td>"; // Order Amount
           
            echo "</tr>";
        }

        echo "</table>";
    } 
    else 
    {
        echo '<p class="text-center mt-5">No orders found in the system.</p>';
    }
    ?>
  </div>
</div>

<?php
include("footer.php");
?>
