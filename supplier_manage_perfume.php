<?php
session_start();
include("supplier_header.php");
include("connect.php");
?>

<script>
  function validation()
  {
    var v = /^[a-zA-Z ]{2,50}$/;
    if(form1.txtname.value == "")
    {
      alert("Perfume Name Required");
      form1.txtname.focus();
      return false;
    }else{
      if(!v.test(form1.txtname.value))
      {
        alert("Invalid Perfume Name");
        form1.txtname.focus();
        return false;
      }
    }

    if(form1.selcat.value == "0")
    {
      alert("Please Select Category");
      form1.selcat.focus();
      return false;
    }

    if(form1.txtdesc.value == "")
    {
      alert("Please Enter Perfume Description");
      form1.txtdesc.focus();
      return false;
    }


    var v =/^[0-9]{1,5}$/
    if(form1.txtprice.value == "")
    {
      alert("Please Enter Perfume Price");
      form1.txtprice.focus();
      return false;
    }
    else if(parseInt(form1.txtprice.value) <= 0)
    {
      alert("Invalid Perfume Price");
      form1.txtdesc.focus();
      return false;
    }
    else if(!v.test(form1.txtprice.value))
    {
      alert("Invalid Perfume Price");
      form1.txtdesc.focus();
      return false;
    }

    var filename = document.getElementById("txtimg").value;
    if(document.getElementById("txtimg").value=="")
    {
      alert("Please Select Perfume Image");
      return false;
    }
  }

  function validation_update()
  {
    var v = /^[a-zA-Z ]{2,50}$/;
    if(form1.txtname.value == "")
    {
      alert("Perfume Name Required");
      form1.txtname.focus();
      return false;
    }else{
      if(!v.test(form1.txtname.value))
      {
        alert("Invalid Perfume Name");
        form1.txtname.focus();
        return false;
      }
    }

    if(form1.selcat.value == "0")
    {
      alert("Please Select Category");
      form1.selcat.focus();
      return false;
    }

    if(form1.txtdesc.value == "")
    {
      alert("Please Enter Perfume Description");
      form1.txtdesc.focus();
      return false;
    }


    var v =/^[0-9]{1,5}$/
    if(form1.txtprice.value == "")
    {
      alert("Please Enter Perfume Price");
      form1.txtprice.focus();
      return false;
    }
    else if(parseInt(form1.txtprice.value) <= 0)
    {
      alert("Invalid Perfume Price");
      form1.txtdesc.focus();
      return false;
    }
    else if(!v.test(form1.txtprice.value))
    {
      alert("Invalid Perfume Price");
      form1.txtdesc.focus();
      return false;
    }

    var filename = document.getElementById("txtimg").value;
   
  }
</script>

<?php
if(isset($_POST["btnsave"]))
{
  $name = $_POST["txtname"];
  $catid = $_POST["selcat"];
  $desc = $_POST["txtdesc"];
  $price = $_POST["txtprice"];

  $res2 = mysqli_query($con,"select max(perfume_id) from perfume_detail");
  $pid=0;
  while($r2=mysqli_fetch_array($res2))
  {
    $pid = $r2[0];
  }
  $pid++;

  $tpath = $_FILES["txtimg"]["tmp_name"];
  $ipath = "perfume_img/".time().".png";

  $sid = $_SESSION["sid"];

  $query = "insert into perfume_detail values($pid,'$name','$catid','$desc','$price','$ipath','$sid')";
  if(mysqli_query($con, $query))
  {
    move_uploaded_file($tpath,$ipath);
    echo "<script>";
    echo "alert('Perfume Detailed Saved');";
    echo "window.location='supplier_manage_perfume.php';";
    echo "</script>";
  }
  else
  {
    echo "<script>";
    echo "alert('Error in Data');";
    echo "window.location='supplier_manage_perfume.php';";
    echo "</script>";
  }
}

if(isset($_REQUEST['dpid']))
{
  $pid1=$_REQUEST['dpid'];
  $query = "delete from perfume_detail where perfume_id='$pid1'";
  if(mysqli_query($con, $query))
  {
    echo "<script>";
    echo "alert('Perfume Deleted');";
    echo "window.location='supplier_manage_fruits.php';";
    echo "</script>";
  }
  else
  {
    echo "<script>";
    echo "alert('Error in deletion');";
    echo "window.location='admin_manage_category.php';";
    echo "</script>";
  }
}

if(isset($_REQUEST['epid']))
{
  $pid1=$_REQUEST['epid'];
  $res5=mysqli_query($con,"select * from perfume_detail where perfume_id = '$pid1'");
  $r5=mysqli_fetch_array($res5);
  $name1 = $r5[1];
  $cid1 = $r5[2];
  $desc1 = $r5[3];  
  $price1 = $r5[4];
  $pimg1 = $r5[5];
}

if(isset($_POST["btnupdate"]))
{
  $name = $_POST["txtname"];
  $desc = $_POST["txtdesc"];
  $cid = $_POST["selcat"];
  $price = $_POST["txtprice"];
  $pid = $_REQUEST['epid'];

  if($_FILES["txtimg"]["size"]>0)
  {
    $tpath = $_FILES["txtimg"]["tmp_name"];
    $ipath = "perfume_img/".time().".png";
    move_uploaded_file($tpath,$ipath);
    $query = "update perfume_detail set perfume_name='$name',category_id='$cid',perfume_description='$desc',perfume_price='$price',perfume_image='$ipath' where perfume_id='$pid'";
  }
  else
  {
    $query = "update perfume_detail set perfume_name='$name',category_id='$cid',perfume_description='$desc',perfume_price='$price' where perfume_id='$pid'";
  }

  
  if(mysqli_query($con, $query))
  {
    echo "<script>";
    echo "alert('Perfume Detail Updated');";
    echo "window.location='supplier_manage_perfume.php';";
    echo "</script>";
  }
  else
  {
    echo "<script>";
    echo "alert('Error in Data');";
    echo "window.location='admin_manage_category.php';";
    echo "</script>";
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

<div class="container">
  <div class="row">
    <div class="col-md-12 text-center mt-3 text-dark">
      <h1>Manage Perfume</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="register-card">
        <form method="post" name="form1" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputEmail1">Perfume Name</label>
            <input type="text" class="form-control" name="txtname" placeholder="Enter Perfume Name" value="<?php echo $name1; ?>">
          </div>

           <div class="form-group">
            <label for="exampleInputEmail1">Select Category</label>
            <select class="form-control" name="selcat">
                <option value="0">Select Category</option>
                <?php
                
                    $res6=mysqli_query($con,"select * from category_perfume");
                    while($r6=mysqli_fetch_array($res6))
                    {
                        ?>

                            <option value="<?php echo $r6[0]; ?>" <?php if($cid1==$r6[0]){echo "selected='selected'";}?> ><?php echo $r6[1]; ?></option>

                        <?php

                    }

                ?>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" name="txtdesc" placeholder="Enter Description" rows="3"><?php echo $desc1; ?></textarea>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="text" class="form-control" name="txtprice" placeholder="Enter Perfume Price" value="<?php echo $price1; ?>">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Image</label>
            <input type="file" class="form-control" name="txtimg" id="txtimg">
          </div>

          <?php
          if(isset($_REQUEST['epid']))
          {
            ?>
              <img src="<?php echo $pimg1; ?>" style="width:80px; height:80px;">
              <button type="submit" class="btn btn-block text-white" name="btnupdate" onclick="return validation_update()" style="background-color: #212121;">Update</button>
            <?php
          }
          else
          {
            ?>
              <button type="submit" class="btn btn-block text-white" name="btnsave" onclick="return validation()" style="background-color: #212121;">Save</button>              
            <?php
          }
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
$suppid = $_SESSION["sid"];
$res3=mysqli_query($con,"select * from perfume_detail where supplier_id = '$suppid'");
if(mysqli_num_rows($res3)>0)
{
  echo "
  <table class='custom-table'> 
    <tr>
      <th>Perfume ID</th>
      <th>Perfume Name</th>
      <th>Category</th>
      <th>Description</th>
      <th>Price</th>
      <th>Perfume Image</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>";

  while($r3=mysqli_fetch_array($res3))
  {
    echo "<tr>";
    echo "<td>$r3[0]</td>";
    echo "<td>$r3[1]</td>";
    $res5=mysqli_query($con,"select * from category_perfume where category_id='$r3[2]'");
    $r5=mysqli_fetch_array($res5);
    echo "<td>$r5[1]</td>";
    echo "<td>$r3[3]</td>";
    echo "<td>$r3[4]</td>";
    echo "<td><img src='$r3[5]' style='width:80px; height:80px;'></td>";
    echo "<td><a href='supplier_manage_perfume.php?epid=$r3[0]' class='btn-action btn-edit'>Edit</a></td>";
    echo "<td><a href='supplier_manage_perfume.php?dpid=$r3[0]' class='btn-action btn-delete' onclick=\"return confirm('Are you sure you want to delete this category?')\">Delete</a></td>";
    echo "</tr>";
  }
  echo "</table>";
}
  
?>

<?php
include("footer.php");
?>
