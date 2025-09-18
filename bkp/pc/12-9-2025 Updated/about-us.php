<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>About Us</title>

<?php include("header.php"); ?>


<section class="container py-md-5 pt-5">
  <div class="row align-items-center">
    <div class="col-sm-12 col-md-6 pe-md-0">
      <img src="images/about-us.jpg" alt="" class="img-fluid">
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="ps-md-4">
        <h2 class="wrap-hding_web1 pb-4">Welcome to <?php echo $domainname_web; ?> – Where Your Journey Begins</h2>

        <p class="wrap-prgh_web1 pb-4">
          At <?php echo $domainname_web; ?>, we believe that travel is more than just booking a ticket — it’s about experiencing the beauty of the world, connecting with different cultures, and creating moments that will stay with you forever. Our mission is to make travel accessible, enjoyable, and stress-free for everyone, whether you’re embarking on a solo adventure, a family vacation, a romantic escape, or a business trip.
        </p>
      </div>
    </div>
  </div>
  <div class="row align-items-center">
    <div class="col-sm-12 col-md-6">
      <div class="pe-md-4">
        <h3 class="wrap-hding_web1 pb-3">Our Story</h3>
        <p class="wrap-prgh_web1 pb-4">Founded with a deep passion for exploration, <?php echo $domainname_web; ?> was created to simplify the travel planning process. We noticed how overwhelming it can be to compare prices, research destinations, and arrange every little detail. That’s why we built a platform that brings everything together in one place — so you can plan, book, and manage your trip with ease.</p>
      </div>  
    </div>
    <div class="col-sm-12 col-md-6 ps-md-0 order-first order-md-last">
      <img src="images/about-us2.jpg" alt="" class="img-fluid">
    </div>
  </div>
  <div class="row align-items-center">
    <div class="col-sm-12 col-md-6 pe-md-0">
      <img src="images/about-us3.jpg" alt="" class="img-fluid">
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="ps-md-4">
        <h2 class="wrap-hding_web1 pb-4">Our Promise</h2>

        <p class="wrap-prgh_web1 pb-4">
          We’re committed to delivering not just a service, but an experience. We take pride in being a part of your travel stories — from the excitement of booking your trip to the joy of returning home with unforgettable memories.<br><br>

          So, whether you’re ticking off your bucket list, revisiting a favorite destination, or exploring somewhere completely new, <?php echo $domainname_web; ?> is here to guide you every step of the way.
        </p>
      </div>
    </div>
  </div>
</section>

<section class="container pt-5">
  <div class="row pb-md-5 ">
    <div class="col-sm-12">
      <h2 class="wrap-hding_web1 pb-4">Why choose Tours</h2>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="wc-box">
        <div class="wc-icon">
          <img src="images/flexibility.png" alt="">
        </div>
        <h3 class="wrap-subhding_web1 pb-2">Ultimate flexibility</h3>
        <p class="wrap-prgh_web1">Enjoy total peace of mind with flexible booking. Cancel for free, reschedule with ease, and choose payment options that fit your budget. </p>
      </div>  
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="wc-box">
        <div class="wc-icon">
          <img src="images/experience.png" alt="">
        </div>
        <h3 class="wrap-subhding_web1 pb-2">Memorable experiences</h3>
        <p class="wrap-prgh_web1">Discover and book unforgettable tours and activities that you’ll be raving about long after your trip. Perfect moments worth sharing with friends and family.</p>
      </div>  
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="wc-box">
        <div class="wc-icon">
          <img src="images/satisfied-customer.png" alt="">
        </div>
        <h3 class="wrap-subhding_web1 pb-2">Trusted for Quality</h3>
        <p class="wrap-prgh_web1">We’re committed to excellence with top-rated tours, verified experiences, and millions of satisfied travelers worldwide. Quality isn’t just a promise </p>
      </div>  
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="wc-box">
        <div class="wc-icon">
          <img src="images/help.png" alt="">
        </div>
        <h3 class="wrap-subhding_web1 pb-2">Award-Winning Support</h3>
        <p class="wrap-prgh_web1">Need to update your plans or pricing? No worries — our dedicated support team is here for you 24/7, ready to help whenever you need it.</p>
      </div>  
    </div>
  </div>
</section>


<section class="container pb-5">
  <div class="row">
    <div class="col-sm-12">
      <h2 class="wrap-hding_web1 pb-4">What We Offer</h2>
    </div>
  </div>
  <div class="row">  
    <div class="col-sm-6 col-md-3">
      <div class="article-box_web1">
         <div class="article-box_web1-img">
           <img src="images/flight-booking.jpg" alt="">
         </div>
         <div class="article-box_web1-textarea">
           <h3 class="wrap-subhding_web1 pb-3">Flight</h3>
           <p class="wrap-prgh_web1">Compare and book tickets with top airlines at the best prices.</p>
         </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="article-box_web1">
         <div class="article-box_web1-img">
           <img src="images/hotel-booking.jpg" alt="">
         </div>
         <div class="article-box_web1-textarea">
           <h3 class="wrap-subhding_web1 pb-3">Hotels </h3>
           <p class="wrap-prgh_web1">Find accommodations that fit your style and budget, from boutique stays to five-star luxury resorts.</p>
         </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="article-box_web1">
         <div class="article-box_web1-img">
           <img src="images/tours-and-activities.jpg" alt="">
         </div>
         <div class="article-box_web1-textarea">
           <h3 class="wrap-subhding_web1 pb-3">Tours & Activities </h3>
           <p class="wrap-prgh_web1">Discover handpicked experiences, from guided city tours to adventure-packed excursions.</p>
         </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="article-box_web1">
         <div class="article-box_web1-img">
           <img src="images/custom-travel.jpg" alt="">
         </div>
         <div class="article-box_web1-textarea">
           <h3 class="wrap-subhding_web1 pb-3">Custom Travel Packages</h3>
           <p class="wrap-prgh_web1">Tailor your trip to match your interests, schedule, and budget.</p>
         </div>
      </div>
    </div>
  </div>
</section>




<?php include("footer.php"); ?>


 