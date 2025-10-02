<?php
session_start();
include("header.php");
include("connect.php");


if(isset($_POST["btnlogin"]))
{
    $email = $_POST["txtemail"];
    $pwd = $_POST["txtpwd"];

    $res1 = mysqli_query($con,"select * from admin_detail where admin_email='$email' and admin_pass='$pwd'");
    if(mysqli_num_rows($res1)>0)
    {
      echo"<script>";
      echo"alert('Loged As Admin');";
      echo"window.location.href='admin_manage_category.php';";
      echo"</script>";
    }
    else
    {
      $res2 = mysqli_query($con,"select * from supplier_detail where supplier_email='$email' and supplier_pass='$pwd'");
    if(mysqli_num_rows($res2)>0)
    {
      $r2=mysqli_fetch_array($res2);
      $_SESSION["sid"] = $r2[0];
      echo"<script>";
      echo"alert('Loged As Supplier');";
      echo"window.location.href='supplier_manage_perfume.php';";
      echo"</script>";
    }
    else
    {
     $res3 = mysqli_query($con,"select * from customer_detail where customer_email='$email' and customer_pass='$pwd'");
    if(mysqli_num_rows($res3)>0)
    {
      $r3=mysqli_fetch_array($res3);
      $_SESSION["custid"] = $r3[0];
      if(isset($_SESSION["ord"]))
      {
        unset($_SESSION["ord"]);
        echo"<script>";
        echo"alert('Loged As Customer');";
        echo"window.location.href='order_form.php';";
        echo"</script>";
      }
      else
      {
        echo"<script>";
        echo"alert('Loged As Customer');";
        echo"window.location.href='perfumes.php';";
        echo"</script>";
      }
    }
    else
    {
      echo"<script>";
      echo"alert('Invalid Email or Password');";
      echo"window.location.href='perfumes.php';";
      echo"</script>";
    }
    }
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

/* Center card vertically and add spacing */
.login-card {
  max-width: 500px;
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
      <h1>Login</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="login-card">
        <form method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Email ID</label>
            <input type="text" class="form-control" name="txtemail" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="txtpwd" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-block text-white" name="btnlogin" style="background-color: #212121;">Login</button>
        </form> 
      </div>
    </div>
  </div>
</div>

<?php
include("footer.php");
?>
