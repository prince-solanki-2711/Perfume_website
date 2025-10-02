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


.contact-card {
  min-height: 320px; 
  background-color: #212121;
  color: white;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 20px;
  text-align: center;
  border-radius: 8px;
}
</style>

<div class="container">
  <div class="row">
    <div class="col-md-12 text-center mt-3 text-dark">
      <h2>Contact Us</h2>
    </div>
  </div>

  <div class="row my-5">
    <div class="col-md-4 mb-3">
      <div class="contact-card">
        <h5>Address</h5>
        <p>
          <strong>Perfume Shop Pvt. Ltd.</strong><br>
          Shop No. 112, First Floor, Iscon Mega Mall,<br>
          SG Highway, Satellite,<br>
          Ahmedabad, Gujarat – 380015, India<br><br>
          📞 +91 98250 12345<br>
          📧 info@perfumeshop.in
        </p>
      </div>
    </div>

    <div class="col-md-4 mb-3">
      <div class="contact-card">
        <h5>Mobile No</h5>
        <p>
          📞 +91 98250 12345<br>
          📞 +91 98765 43210
        </p>
      </div>
    </div>

    <div class="col-md-4 mb-3">
      <div class="contact-card">
        <h5>Email ID</h5>
        <p>
          📧 perfumeshop@gmail.com
        </p>
      </div>
    </div>
  </div>
</div>

<?php
include("footer.php");
?>
