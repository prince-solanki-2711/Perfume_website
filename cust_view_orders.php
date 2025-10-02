<?php
session_start();
include("header.php");
include("connect.php");
?>


<style>
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
.btn-delete {
  background-color: #f44336;
}
.btn-delete:hover {
  background-color: #d32f2f;
}
</style>

<div class="page-content"> 
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center mt-3 text-dark">
        <h1>View Orders</h1>
      </div>
    </div>

    <?php
    $custid = $_SESSION["custid"];
    $tot=0;
    $res3=mysqli_query($con,"select * from order_detail where Customer_id = '$custid'");
    if(mysqli_num_rows($res3)>0)
    {
      echo "
      <table class='custom-table'> 
        <tr>
          <th>Order ID</th>
          <th>Order Date</th>
          <th>Cart ID</th>
          <th>Delivery Address</th>
          <th>Delivery Mobile No</th>
          <th>Amount</th>
          <th>View Order Detail</th>
        </tr>";

      while($r3=mysqli_fetch_array($res3))
      {
        echo "<tr>";
        
        
        echo "<td>$r3[0]</td>";
        echo "<td>$r3[1]</td>";
        
        echo "<td>$r3[2]</td>";
        echo "<td>$r3[4]</td>";
        echo "<td>$r3[5]</td>";
        echo "<td>&#8377;$r3[6] /-</td>";
        echo "<td><a href='cust_view_order_detail.php?cid=$r3[2]'>View Order Detail</a></td>";

        echo "</tr>";
      }
      echo "</table>";

    }

    else
    {
      echo "<h3 class='text-center text-dark mt-4'>Oops.. No Orders Yet</h3>";
    }
    ?>
  </div>
</div>

<?php
include("footer.php");
?>
