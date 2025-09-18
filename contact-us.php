<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Contact Us</title>

<?php include("header.php"); ?>


<section class="container py-5">
  <div class="row align-items-center">
    <div class="col-lg-4 pe-lg-0">
      <div class="contact-adrs-box_web1">
        <h2 class="wrap-hding_web1 pb-4">Get in Tourch</h2>
        <address>
          <div class="mb-3 d-flex align-items-center gap-4">
            <p class="wrap-title_web1 fa-2x mb-0 main-color">
              <i class="fa-solid fa-phone-volume"></i>
            </p>
            <div>
              <h3 class="wrap-prgh_web1 fw-bold main-color">Call Us</h3>
              <a href="tel:<?php echo $phone_web; ?>" class="wrap-subhding_web1  d-block text-decoration-none text-dark pt-1"><?php echo $phone_web; ?></a>
            </div>  
          </div>
          <div class="mb-3 d-flex align-items-center gap-4">
            <p class="wrap-title_web1 fa-2x mb-0 main-color">
              <i class="fa-solid fa-envelope"></i>
            </p>
            <div>
              <h3 class="wrap-prgh_web1 fw-bold main-color">Email</h3>
              <a href="maito:<?php echo $email_web ?>" class="wrap-subhding_web1  d-block text-decoration-none text-dark pt-1"><?php echo $email_web ?></a>
            </div>  
          </div>
          <div class="mb-3 d-flex align-items-center gap-4">
            <p class="wrap-title_web1 fa-2x mb-0 main-color">
              <i class="fa-solid fa-building"></i>
            </p>
            <div>
              <h3 class="wrap-prgh_web1 fw-bold main-color">Address</h3>
              <p class="wrap-subhding_web1  d-block text-decoration-none text-dark pt-1">
                3612 Windshire Dr Springfield, IL 62704, USA
              </p>
            </div>  
          </div>
          
        </address>
      </div>
    </div>
    <div class="col-lg-8 ps-lg-0">
      <div class="contact-formbox_web1">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3067.660642795187!2d-89.6963805247957!3d39.74727317155502!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x887538a451072499%3A0x43c04ed97b0ae4d1!2s3612%20Windshire%20Dr%2C%20Springfield%2C%20IL%2062704%2C%20USA!5e0!3m2!1sen!2sin!4v1754925521618!5m2!1sen!2sin" style="border:0; width:100%; height: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>

<!-- <section class="container py-5">
  <div class="row justify-content-around align-items-center">
    <div class="col-md-12">
    </div>
    <div class="col-12 col-md-5 mb-3">
      <div class="box-shadow_web1  rounded-4 px-4 py-3 mb-3 d-flex align-items-center gap-4">
        <p class="wrap-title_web1 fa-2x mb-0">
          <i class="fa-solid fa-phone-volume"></i>
        </p>
        <div>
          <h3 class="wrap-subhding_web1 main-color">Call Us</h3>
          <a href="tel:<?php echo $phone_web; ?>" class="wrap-subhding_web1  d-block text-decoration-none text-dark"><?php echo $phone_web; ?></a>
        </div>  
      </div>
      <div class="box-shadow_web1  rounded-4 px-4 py-3 mb-3 d-flex align-items-center gap-4">
        <p class="wrap-title_web1 fa-2x mb-0">
          <i class="fa-solid fa-envelope"></i>
        </p>
        <div>
          <h3 class="wrap-subhding_web1 main-color">Email Id</h3>
          <a href="mailto:<?php echo $email_web; ?>" class="wrap-subhding_web1 d-block text-decoration-none text-dark"><?php echo $email_web; ?></a>
        </div>  
      </div>
      <div class="box-shadow_web1  rounded-4 px-4 py-3 mb-3 d-flex align-items-center gap-4">
        <p class="wrap-title_web1 fa-2x mb-0">
          <i class="fa-solid fa-building"></i>
        </p>
        <div>
          <h3 class="wrap-subhding_web1 main-color">Address</h3>
          <h4 class="wrap-subhding_web1 d-block text-decoration-none text-dark">3612 Windshire Dr Springfield, IL 62704, USA</h4>
        </div>  
      </div>
    </div>
    <div class="col-12 col-lg-5">
      <img src="images/contact-us.jpg" alt="" class="img-fluid about-img-radius mb-3 h-100 object-fit-cover">
    </div>
  </div>
</section>
 -->


<?php include("footer.php"); ?>


 