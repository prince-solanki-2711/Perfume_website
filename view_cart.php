<?php
session_start();
include("header.php");
include("connect.php");

if(isset($_REQUEST["dpid"]))
{
    $pid = $_REQUEST["dpid"];
    $cartid = $_SESSION["cartid"];
    $query3 = "delete from cart_detail where cart_id='$cartid' and perfume_id='$pid'";
    if(mysqli_query($con,$query3))
    {
        echo "<script>";
        echo "alert('Item Deleted from Cart');";
        echo "window.location='view_cart.php';";
        echo "</script>";
    }
    else
    {
        echo "<script>";
        echo "alert('Error in Deleting Item');";
        echo "window.location='view_cart.php';";
        echo "</script>";
    }
}

if(isset($_REQUEST["ord"]))
{
    if(isset($_SESSION["custid"]))
    {
        echo "<script>";
        echo "window.location='order_form.php';";
        echo "</script>";
    }
    else
    {
        $_SESSION["ord"]= "x";
        echo "<script>";
        echo "alert('Please Login to Place Order');";
        echo "window.location='login.php';";
        echo "</script>";
    }
}
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
        <h1>View Cart</h1>
      </div>
    </div>

    <?php
    $cartid = $_SESSION["cartid"];
    $tot=0;
    $res3=mysqli_query($con,"select * from cart_detail where cart_id = '$cartid'");
    if(mysqli_num_rows($res3)>0)
    {
      echo "
      <table class='custom-table'> 
        <tr>
          <th>Perfume Image</th>
          <th>Perfume Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Amount</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>";

      while($r3=mysqli_fetch_array($res3))
      {
        echo "<tr>";
        
        $res5=mysqli_query($con,"select * from perfume_detail where perfume_id='$r3[1]'");
        $r5=mysqli_fetch_array($res5);
        echo "<td><img src='$r5[5]' style='width:80px; height:80px;'></td>";
        echo "<td>$r5[1]</td>";
        echo "<td>$r3[2]</td>";
        
        echo "<td>&#8377; $r3[3] /-</td>";
        $amt = $r3[2] * $r3[3];
        $tot = $tot + $amt;
        echo "<td>&#8377;$amt /-</td>";
        echo "<td><a href='update_cart_qty.php?pid=$r3[1]&oqty=$r3[2]' class='btn-action btn-edit'>Edit</a></td>";
        echo "<td><a href='view_cart.php?dpid=$r3[1]' class='btn-action btn-delete' onclick=\"return confirm('Are you sure you want to delete this item?')\">Delete</a></td>";
        echo "</tr>";
      }
      echo "</table>";

        echo "<h2 class='text-center text-dark mt-4'>Total Amount: &#8377; $tot /-</h2>";

        echo "<div class='text-center mt-3'>
        <a href='view_cart.php?ord=x' class='btn text-white' style='background-color: #212121;'>Place Order</a>
      </div>";

    }

    else
    {
      echo "<h3 class='text-center text-dark mt-4'>Oops.. Cart is Empty</h3>";
    }
    ?>
  </div>
</div>

<?php
include("footer.php");
?>
