<?php
include("admin_header.php");
include("connect.php");
?>

<script>
  function validation()
  {
    var v = /^[a-zA-Z ]{2,50}$/;
    if(form1.txtcat.value == "")
    {
      alert("Category Name Required");
      form1.txtcat.focus();
      return false;
    }else{
      if(!v.test(form1.txtcat.value))
      {
        alert("Invalid Category Name");
        form1.txtcat.focus();
        return false;
      }
    }
  }
</script>

<?php
if(isset($_POST["btnsave"]))
{
  $cat = $_POST["txtcat"];
  $res2 = mysqli_query($con,"select max(category_id) from category_perfume");
  $cid=0;
  while($r2=mysqli_fetch_array($res2))
  {
    $cid = $r2[0];
  }
  $cid++;

  $query = "insert into category_perfume values($cid,'$cat')";
  if(mysqli_query($con, $query))
  {
    echo "<script>";
    echo "alert('Category Saved');";
    echo "window.location='admin_manage_category.php';";
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

if(isset($_REQUEST['dcid']))
{
  $cid1=$_REQUEST['dcid'];
  $query = "delete from category_perfume where category_id='$cid1'";
  if(mysqli_query($con, $query))
  {
    echo "<script>";
    echo "alert('Category Deleted');";
    echo "window.location='admin_manage_category.php';";
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

if(isset($_REQUEST['ecid']))
{
  $cid1=$_REQUEST['ecid'];
  $res5=mysqli_query($con,"select * from category_perfume where category_id = '$cid1'");
  $r5=mysqli_fetch_array($res5);
  $cat1 = $r5[1];
}

if(isset($_POST["btnupdate"]))
{
  $cat = $_POST["txtcat"];
  $cid = $_REQUEST['ecid'];

  $query = "update category_perfume set category_name='$cat' where category_id='$cid'";
  if(mysqli_query($con, $query))
  {
    echo "<script>";
    echo "alert('Category Updated');";
    echo "window.location='admin_manage_category.php';";
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
      <h1>Manage Category</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="register-card">
        <form method="post" name="form1">
          <div class="form-group">
            <label for="exampleInputEmail1">Category</label>
            <input type="text" class="form-control" name="txtcat" placeholder="Enter Category" value="<?php echo $cat1; ?>">
          </div>

          <?php
          if(isset($_REQUEST['ecid']))
          {
            ?>
              <button type="submit" class="btn btn-block text-white" name="btnupdate" onclick="return validation()" style="background-color: #212121;">Update</button>
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
$res3=mysqli_query($con,"select * from category_perfume");
if(mysqli_num_rows($res3)>0)
{
  echo "
  <table class='custom-table'> 
    <tr>
      <th>Category ID</th>
      <th>Category Name</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>";

  while($r3=mysqli_fetch_array($res3))
  {
    echo "<tr>
            <td>$r3[0]</td>
            <td>$r3[1]</td>
            <td><a href='admin_manage_category.php?ecid=$r3[0]' class='btn-action btn-edit'>Edit</a></td>
            <td><a href='admin_manage_category.php?dcid=$r3[0]' class='btn-action btn-delete' onclick=\"return confirm('Are you sure you want to delete this category?')\">Delete</a></td>
          </tr>";
  }
  echo "</table>";
}
?>

<?php
include("footer.php");
?>
