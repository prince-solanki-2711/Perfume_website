<?php
include("header.php");
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
</style>

<div class="carousel-container">
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="assets/img/banner_ed1.png" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="assets/img/banner_ed2.png" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="assets/img/banner_ed3.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>


<div class="container">
  <div class="row">
    <div class="col-md-12 text-center mt-3 text-dark">
      <h2>Welcome to PerfumeShop.com</h2>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-md-6">
        <img src="assets/img/gif1.gif" style="width: 350px;"/>
    </div>
    <div class="col-md-6">
        <div class="card" style="width: 100%;">
          <div class="card-body">
            <h5 class="card-title text-center">"Crafted for those who dare to be unforgettable."</h5>
            <p class="card-text text-justify">

                we believe that perfume is more than just a fragrance — it's a reflection of identity, mood, and personality. Each bottle we offer is carefully crafted to evoke emotion, captivate the senses, and leave an unforgettable impression. Whether you're stepping into a business meeting, heading out on a romantic evening, or embracing your daily routine, the right scent transforms your presence into a lasting memory.
        
            </p>

            <p class="card-text text-justify">
                🔹 Premium Ingredients
                We source the finest ingredients from around the world — from rich Middle Eastern oud to delicate French lavender — to ensure every scent is pure, authentic, and long-lasting.
            </p>

            <p class="card-text text-justify">
              🔹 Designed by Experts
              Our fragrances are formulated by world-renowned perfumers who understand the deep science and subtle artistry of scent layering and composition.
            </p>

            <p class="card-text text-justify">
              🔹 For Every Personality
              Whether you prefer floral, woody, spicy, citrus, or musky notes, our curated collection ensures there's a perfect fragrance for every mood, season, and occasion.
            </p>
            
          </div>
      </div>
    </div>
  </div>
  
</div>

<?php
include("footer.php");
?>
  