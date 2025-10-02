<?php
include("header.php");
include("connect.php");
?>

<script>
  function validation()
  {
    var v = /^[a-zA-Z ]{2,50}$/
    if(form1.txtname.value == "")
    {
      alert("Name Required");
      form1.txtname.focus();
      return false;
    }else{
      if(!v.test(form1.txtname.value))
      {
        alert("Valid Name Required");
        form1.txtname.focus();
        return false;
      }
    }

    if(form1.txtadd.value == "")
    {
      alert("Address Required");
      form1.txtname.focus();
      return false;
    }

    if(form1.txtcity.value == "")
    {
      alert("City Name Required");
      form1.txtname.focus();
      return false;
    }else{
      if(!v.test(form1.txtcity.value))
      {
        alert("Valid City Name Required");
        form1.txtcity.focus();
        return false;
      }
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

    var v = /^[a-zA-Z0-9.-_]+@[a-zA-Z0-9.-_]+\.([a-zA-Z]{2,4})+$/
    if(form1.txtemail.value == "")
    {
      alert("Email ID Required");
      form1.txtemail.focus();
      return false;
    }else{
      if(!v.test(form1.txtemail.value))
      {
        alert("Valid Email ID Required");
        form1.txtemail.focus();
        return false;
      }
    }

    if(form1.txtpwd.value == "")
    {
      alert("Password Required");
      form1.txtpwd.focus();
      return false;
    }
    else if(form1.txtpwd.value.length < 6)
    {
      alert("Password Must Be At Least 6 Characters");
      form1.txtpwd.focus();
      return false;
    }

    else if(form1.txtpwd.value.length > 10)
    {
      alert("Password Must Be Less Than 10 Characters");
      form1.txtpwd.focus();
      return false;
    }
  }
</script>

<?php
if(isset($_POST["btnregis"]))
{
  $name = $_POST["txtname"];
  $add = $_POST["txtadd"];
  $city = $_POST["txtcity"];
  $mno = $_POST["txtmno"];
  $email = $_POST["txtemail"];
  $pwd = $_POST["txtpwd"];

  $res1 = mysqli_query($con,"select * from supplier_detail where supplier_email='$email'");
  if(mysqli_num_rows($res1) > 0)
  {
    echo "<script>";
    echo "alert('Email Already Exist');";
    echo "window.location='supplier_registration.php';";
    echo "</script>";
  }
  else
  {
    $res2 = mysqli_query($con,"select max(supplier_id) from supplier_detail");
    $sid=0;
    while($r2=mysqli_fetch_array($res2))
    {
      $sid = $r2[0];
    }
    $sid++;

      $query = "insert into supplier_detail values($sid,'$name','$add','$city','$mno','$email','$pwd')";
      if(mysqli_query($con, $query))
      {
        echo "<script>";
        echo "alert('Registration Successful');";
        echo "window.location='login.php';";
        echo "</script>";
      }
      else
      {
        echo "<script>";
        echo "alert('Registration Failed');";
        echo "window.location='supplier_registration.php';";
        echo "</script>";
        
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
      <h1>Supplier Registration</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="register-card">
        <form method="post" name="form1">
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="txtname" placeholder="Enter Name">
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Address</label>
            <textarea class="form-control" name="txtadd" placeholder="Enter Address" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">City</label>
            <input type="text" class="form-control" name="txtcity" placeholder="Enter City Name">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Mobile No</label>
            <input type="text" class="form-control" name="txtmno" placeholder="Enter Mobile No">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Email ID</label>
            <input type="text" class="form-control" name="txtemail" placeholder="Enter Email">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="txtpwd" placeholder="Password">
          </div>

          <button type="submit" class="btn btn-block text-white" name="btnregis" onclick="return validation()" style="background-color: #212121;">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include("footer.php");
?>
