<?php
session_start();
include("header.php");
include("connect.php");
?>

<script>
  function validation()
  {
    
    if(form1.txtadd.value == "")
    {
      alert("Address Required");
      form1.txtname.focus();
      return false;
    }



    var v = /^[0-9]{10,10}$/
    if(form1.txtmno.value == "")
    {
      alert("Mobile No Required");
      form1.txtmno.focus();
      return false;
    }
    else if(form1.txtmno.value.length != 10)
    {
      alert("Mobile No Must Be 10 Digits");
      form1.txtmno.focus();
      return false;
    }
   
    else
    {
      if(!v.test(form1.txtmno.value))
      {
        alert("Valid Mobile No Required");
        form1.txtmno.focus();
        return false;
      }
    }

    
  }
</script>

<?php
if(isset($_POST["btnorder"]))
{
  $cartid = $_SESSION["cartid"];
  $custid = $_SESSION["custid"];
  $odate = date("Y-m-d");
  $add = $_POST["txtadd"];
  $mno = $_POST["txtmno"];

  $res1 = mysqli_query($con,"select sum(cart_quantity*cart_price) from cart_detail where cart_id='$cartid'");
  $r1=mysqli_fetch_array($res1);  
  $amt = $r1[0];
  
    $res2 = mysqli_query($con,"select max(order_id) from order_detail");
    $oid=0;
    while($r2=mysqli_fetch_array($res2))
    {
      $oid = $r2[0];
    }
    $oid++;

      $query = "insert into order_detail values('$oid','$odate','$cartid','$custid','$add','$mno','$amt')";
      if(mysqli_query($con, $query))
      {
        unset($_SESSION["cartid"]);
        echo "<script>";
        echo "alert('Horahh!! Order Placed');";
        echo "window.location='cust_view_orders.php';";
        echo "</script>";
      }
      else
      {
        echo "Errror In Order: ".mysqli_error($con);
        /*echo "<script>";
        echo "alert('Oppss! Failed To Place Order');";
        echo "</script>";*/
        
      }
  
}
?>



<style>
.carousel-container {
  max-width: 1300px;
  margin: 40px auto;
  border: 5px solid black;
  border-radius: 20px;
  overflow: hidden;
}

.carousel-inner img {
  width: 150px;
  height: auto;
  object-fit: cover;
}


.register-card {
  max-width: 600px;
  margin: 60px auto;
  box-shadow: 0 0 15px rgba(0,0,0,0.2);
  border-radius: 10px;
  padding: 30px;
  background-color: #f8f9fa;
}
</style>

<div class="container">
  <div class="row">
    <div class="col-md-12 text-center mt-3 text-dark">
      <h1>Order Form</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="register-card">
        <form method="post" name="form1">
    
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Address</label>
            <textarea class="form-control" name="txtadd" placeholder="Enter Delievery Address" rows="3"></textarea>
          </div>

        

          <div class="form-group">
            <label for="exampleInputEmail1">Mobile No</label>
            <input type="text" class="form-control" name="txtmno" placeholder="Enter Mobile No">
          </div>


          <button type="submit" class="btn btn-block text-white" name="btnorder" onclick="return validation()" style="background-color: #212121;">Place Order</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include("footer.php");
?>
