<?php
include("admin_header.php");
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
        <h1>supplier Detail</h1>
      </div>
    </div>

    <?php
   
        $query = mysqli_query($con, "select * from supplier_detail");

        if(mysqli_num_rows($query) > 0) 
        {
            echo "<table class='custom-table'>";
            echo "<tr>
            <th>Supplier ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Mobile No</th>
            <th>Email ID</th>
            <th>Password</th>
            </tr>";

            while ($r5 = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>$r5[0]</td>";
                echo "<td>$r5[1]</td>";
                echo "<td>$r5[2]</td>";
                echo "<td>$r5[3]</td>";
                echo "<td>$r5[4]</td>";
                echo "<td>$r5[5]</td>";
                echo "<td>$r5[6]</td>";
                echo "</tr>";
            }

            echo "</table>";
        } 
        else 
        {
            echo '<p class="text-center">No Supplier Found.</p>';
        }
   
    ?>
  </div>
</div>

<?php
include("footer.php");
?>
