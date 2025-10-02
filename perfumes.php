<?php
include("header.php");
include("connect.php");
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


.card-img-top {
  width: 100%;
  height: 250px; 
  object-fit: contain;
  background-color: #fff; 
  border-radius: 10px 10px 0 0;
}
.card {
  display: flex;
  flex-direction: column;
  height: 100%; 
}
.card-body {
  flex: 1; 
  display: flex;
  flex-direction: column;
  justify-content: space-between; 
}
</style>

<div class="container">
  <div class="row">
    <div class="col-md-12 text-center mt-3 text-dark">
      <h2>Perfume</h2>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-md-3">
        <h2>Category</h2>
        <ul>
        <?php
            $res1=mysqli_query($con,"select * from category_perfume");
            while($r1=mysqli_fetch_array($res1))
            {
                ?>
                    <li class="pt-3"><h4><a href='perfumes.php?cid=<?php echo $r1[0]; ?>'><?php echo $r1[1]; ?></a></h4></li>               
                <?php
            }
        ?>
        </ul>
    </div>
    <div class="col-md-9">
        <div class="row">
            <?php
            if(isset($_REQUEST['cid']))
            {
                $cid=$_REQUEST['cid'];
                $query = "select * from perfume_detail where category_id='$cid'";
            }
            else
            {
                $query = "select * from perfume_detail";
            }
           
            $res2 = mysqli_query($con,$query);
            if(mysqli_num_rows($res2)>0)
            {
                while($r2=mysqli_fetch_array($res2))
                {
                    ?>
                    <div class="col-md-6 mt-3">
                        <div class="card h-100" style="width: 100%;">
                            <img class="card-img-top" src="<?php echo $r2[5]; ?>" alt="Perfume Image">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title"><?php echo $r2[1]; ?></h5>
                                    <p class="card-text">Price: &#8377; <?php echo $r2[4]; ?> /- </p>
                                </div>
                                <a href="perfume_detail.php?pid=<?php echo $r2[0]; ?>" class="btn btn-primary mt-3" style="background-color:#212121;">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                echo"No Perfume Available";
            }
            ?>
        </div>
      </div>
    </div>
  </div>
  
</div>

<?php
include("footer.php");
?>
