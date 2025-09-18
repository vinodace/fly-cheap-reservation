<?php

  

  // User First Letter of Name for Initial
  $firstInitial = strtoupper(substr($user['first_name'], 0, 1));
  $lastInitial  = strtoupper(substr($user['last_name'], 0, 1));

  // Example: First Name -> FN
  $initials = $firstInitial . $lastInitial;

?>

<aside class="my_account-sidebar">
  <div class="profile-imgarea">
    <div class="profile-nameimg">
      <span id="profile-picname"> <?= $initials ?> </span>
    </div>
  </div>
  <h2 class="my_account-title text-center"><?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
  <p class="my_account-desig"><?= htmlspecialchars($user['user_phone']) ?></p>
  <?php
    $nav1=$nav2=$nav3=$nav4="";
    $tt=explode("/",$_SERVER['PHP_SELF']);
    $len=count($tt)-1;
    $cur_page=$tt[$len];
    switch($cur_page)
    {
    case "index.php":
    $nav1='active';
    break;
    case "my-booking.php":
    $nav2='active';
    break;
    case "my-activites.php":
    $nav3='active';
    break;
    case "help-desk.php":
    $nav4='active';
    break;
    }
  ?>
  <ul class="my_account-sidemenu">
    <li class="<?php echo $nav1; ?>"><a href="./"><i class="far fa-user"></i> My Profile</a></li>
    <li class="<?php echo $nav2; ?>"><a href="my-booking.php"><i class="fa-solid fa-ticket"></i> My Booking</a></li>
    <li class="<?php echo $nav3; ?>"><a href="my-activities.php"><i class="fas fa-suitcase-rolling"></i> My Activities</a></li>
    <li class="<?php echo $nav4; ?>"><a href="help-desk.php"><i class="fas fa-headphones-alt"></i> Help Desk</a></li>
    <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#logout-modal"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
  </ul>
</aside>
<!-- Logout Modal -->
<div class="modal fade modaldesign_web1" id="logout-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button class="close-btn" data-bs-dismiss="modal">×</button>
        <div class="p-4">
          <h2 class="modal-title text-center pb-2">Logout</h2>
          <p class="wrap-prgh text-center">Are you sure do you want to logout ?</p>
          <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="javascript:void(0)" class="wrap-btn_web1 bg-dark border-dark" data-bs-dismiss="modal">No</a>
            <a href="../logout.php" class="wrap-btn_web1 bg-danger border-danger">Yes</a>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>