<?php
  $rootPath = $_SERVER['DOCUMENT_ROOT'] . "/ace-digital-solution/projects/September/flycheapreservation.com/";

?>
<?php include("register_form_fetch.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Help Desk</title>

<?php include($rootPath . "header.php");  ?>


<section class="gray-bg pt-0 pt-md-4 active">
  <div class="container">
    <div class="row pt-3 pb-5">
      <div class="col-sm-12 col-md-3">
        <?php include("sidebar.php") ?>
      </div>

      <div class="col-lg-9">
        <div class="row">
          <div class="col-12 col-sm">
            <div class="my_account-box">
              <div class=" my_account-box-leftline"></div>
              <div class="row pb-4">
                <div class="col-md-8">
                  <h2 class="my_account-title pb-2">Help Desk</h2>    
                  <p class="my_account-subtitle">Need assistance? Our Help Desk team is here to support you with booking issues, cancellations, refunds, or any travel-related queries.</p>    
                </div>
                <div class="w-100 mt-4"></div>
                <div class="col-md-6">
                  <div class="d-flex align-items-center gap-4">
                    <p class="wrap-title_web1 fa-2x mb-0 main-color">
                      <i class="fa-solid fa-phone-volume"></i>
                    </p>
                    <h3 class="">Phone <br> <?php echo $phone_web; ?></h3>
                  </div>  
                </div>
                <div class="col-md-6">
                  <div class="d-flex align-items-center gap-4">
                    <p class="wrap-title_web1 fa-2x mb-0 main-color">
                      <i class="fa-solid fa-envelope"></i>
                    </p>
                    <h3 class="">Email <br> <?php echo $email_web; ?></h3>
                  </div>  
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php include($rootPath . "footer.php"); ?>


 

