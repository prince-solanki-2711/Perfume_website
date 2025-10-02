<?php
session_start();
include("header.php");
include("connect.php");

$pid = $_REQUEST['pid'];
$res1 = mysqli_query($con, "select * from perfume_detail where perfume_id='$pid'");
$r1 = mysqli_fetch_array($res1);
$name = $r1[1];
$catid = $r1[2];
$desc = $r1[3];
$price = $r1[4];
$pimg1 = $r1[5];
$sid = $r1[6];
?>

<script>
    function validation()
    {
        var v = /^[0-9]{1,3}$/;
        if(form1.txtqty.value=="")
        {
            alert("Please Enter Quantity");
            form1.txtqty.focus();
            return false;
        }
        else if(parseInt(form1.txtqty.value)<=0)
        {
            alert("Please Enter Valid Quantity");
            form1.txtqty.focus();
            return false;
        }
        else if(!v.test(form1.txtqty.value))
        {
            alert("Please Enter Valid Quantity");
            form1.txtqty.focus();
            return false;
        }
        else
        {

        }
    }    
</script>

<?php
    if(isset($_POST["btncart"]))
    {
        $qty = $_POST["txtqty"];
        if(isset($_SESSION["cartid"]))
        {
            $cid = $_SESSION["cartid"];
            $query2="insert into cart_detail values('$cid','$pid','$qty','$price')";
                if(mysqli_query($con,$query2))
                {
                $_SESSION["cartid"] = $cid;
                echo "<script>";
                echo "alert('item Added to Cart');";
                echo "window.location='perfumes.php';";
                echo "</script>";
                }
        }  
        else
        {
            $res2 = mysqli_query($con,"select max(cart_id) from cart_master");
            $cid=0;
            while($r2=mysqli_fetch_array($res2))
            {
            $cid = $r2[0];
            }
            $cid++;
            $tdate = date("Y-m-d");
            $query = "insert into cart_master values($cid,'$tdate')";
            if(mysqli_query($con, $query))
            {
                $query2="insert into cart_detail values('$cid','$pid','$qty','$price')";
                if(mysqli_query($con,$query2))
                {
                $_SESSION["cartid"] = $cid;
                echo "<script>";
                echo "alert('item Added to Cart');";
                echo "window.location='perfumes.php';";
                echo "</script>";
                }
            }
            else
            {
                echo "<script>";
                echo "alert('Failed to Add Items');";
                echo "window.location='perfumes.php';";
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
      <h1>Perfume Details</h1>
    </div>
  </div>

  <div class="row">
    
    <div class="col-md-6 text-center">
      <img src="<?php echo $pimg1; ?>"  class="img-fluid" style="max-height:400px; border-radius:10px;">
    </div>
    
    <div class="col-md-6">
      <div class="login-card">
        <form method="post" name="form1">
        <div class="form-group">
            <h4>Perfume Name : <?php echo $name; ?></h4>
        </div>

        <div class="form-group">
            <h4>Description : <?php echo $desc; ?></h4>
        </div>

        
        <div class="form-group">
            <h4>Price : &#8377; <?php echo $price; ?>/-</h4>
        </div>

         <div class="form-group">
            <label for="exampleInputEmail1">Enter Quantity</label>
            <input type="number" class="form-control" name="txtqty" placeholder="Enter Quantity" >
          </div>
          
          
          <button type="submit" class="btn btn-block text-white" onclick="return validation();" name="btncart" style="background-color: #212121;">Add To Cart</button>
        </form> 
      </div>
    </div>
  </div>
</div>

<?php
include("footer.php");
?>
