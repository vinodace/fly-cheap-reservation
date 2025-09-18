
<?php
//session_start();


// Make sure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'includes/db_connect.php'; 

// If not logged in → redirect to root login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ./"); 
    exit();
}


$user_id = $_SESSION['user_id'];

// Fetch user details from DB
$stmt = $conn->prepare("SELECT first_name, last_name, user_email, user_phone, created_at 
                        FROM users 
                        WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>My Account</title>
<?php //echo BASE_URL; ?>

<?php include("header.php");  ?>

<!-- <div class="myaccount-pt"></div> -->

<section class="gray-bg pt-0 pt-md-4 active">
  <div class="container">
    <div class="row pt-3 pb-5">
      <div class="col-sm-12 col-md-3">
        <aside class="my_account-sidebar">
          <div class="profile-imgarea">
            <div class="profile-nameimg">
              <span id="profile-picname"> Vk </span>
            </div>
          </div>
          <h2 class="my_account-title text-center"><?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
          <p class="my_account-desig"><?= htmlspecialchars($user['user_phone']) ?> </p>

          <ul class="my_account-sidemenu">
            <li class="active"><a href="my-profile.php"><i class="far fa-user"></i> My Profile</a></li>
            <li><a href="my-booking.php"><i class="fas fa-suitcase-rolling"></i> My Booking</a></li>
            <li><a href="help-desk.php"><i class="fas fa-headphones-alt"></i> Help Desk</a></li>
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
      </div>

      <div class="col-lg-9">
        <div class="row">
          <div class="col-12 col-sm">
            <h2 class="my_account-title pb-3"><?php echo "Welcome, " . htmlspecialchars($_SESSION['user_name']); ?></h2>
            <div class="my_account-box">
              <div class=" my_account-box-leftline"></div>
              <div class="row">
                <div class="col">
                  <h2 class="my_account-title">My Profile</h2>    
                  <p class="my_account-subtitle">Basic info for a baster booking experience</p>    
                </div>
                <div class="col-auto">
                  <a href="javascript:void(0)" class="my_account-edit-btn" data-toggle="modal" data-target="#edit-profile"><i class="fas fa-pencil-alt"></i> Edit</a>
                </div>
              </div>
              <ul class="my_account-detail">
                <li>
                  <div class="my_account-detail-hding">Name</div>
                  <div class="my_account-detail-info"><?php echo htmlspecialchars($_SESSION['user_name']); ?></div>
                </li>
                <li>
                  <div class="my_account-detail-hding">Email</div>
                  <div class="my_account-detail-info"><?= htmlspecialchars($user['user_email']) ?></div>
                </li>
                <li>
                  <div class="my_account-detail-hding">Phone</div>
                  <div class="my_account-detail-info"><?= htmlspecialchars($user['user_phone']) ?></div>
                </li>
                <li>
                  <div class="my_account-detail-hding">Account Created</div>
                  <div class="my_account-detail-info"><?= htmlspecialchars($user['created_at']) ?></div>
                </li>
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php include($rootPath . "footer.php"); ?>


 

