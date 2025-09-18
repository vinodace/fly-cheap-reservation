<?php
  $rootPath = $_SERVER['DOCUMENT_ROOT'] . "/";

?>
<?php
include("register_form_fetch.php");

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $old_password     = $_POST['old_password'] ?? '';
    $new_password     = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Fetch current password hash from DB
    $stmt = $conn->prepare("SELECT user_password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    if (!$hashed_password) {
        $msg = "<div class='text-danger'>❌ User not found.</div>";
    } elseif (!password_verify($old_password, $hashed_password)) {
        $msg = "<div class='login_singup_errmsg text-danger'>❌ Old password is incorrect.</div>";
    } elseif ($new_password !== $confirm_password) {
        $msg = "<div class='login_singup_errmsg text-danger'>❌ New passwords do not match.</div>";
    } elseif (strlen($new_password) < 6) {
        $msg = "<div class='login_singup_errmsg text-danger'>❌ Password must be at least 6 characters.</div>";
    } else {
        // Hash new password
        $new_hashed = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE id = ?");
        $stmt->bind_param("si", $new_hashed, $user_id);
        if ($stmt->execute()) {
            $msg = "<div class='login_singup_errmsg text-success'>✅ Password changed successfully.</div>";
        } else {
            $msg = "<div class='login_singup_errmsg text-danger'>❌ Error: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Settings</title>

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
                  <h2 class="my_account-title pb-2">Change Password</h2>    
                  <p class="my_account-subtitle">Keep your account secure by updating your password regularly. Enter your current password and set a new one to continue.</p>    
                </div>
                <div class="w-100 mt-3"></div>
                <div class="col-md-6">  
                  <form method="post">
                    <div class="form-group position-relative mb-3">
                      <label class="form-lbl">Old Password</label>
                      <input type="password" class="form-field" name="old_password">
                    </div>
                    <div class="form-group position-relative mb-3">
                      <label class="form-lbl">New Password</label>
                      <input type="password" class="form-field" name="new_password">
                    </div>
                    <div class="form-group position-relative mb-3">
                      <label class="form-lbl">Confirm Password</label>
                      <input type="password" class="form-field" name="confirm_password">
                    </div>
                    <?php echo $msg; ?>
                    <button type="submit" name="submit" class="wrap-btn_web1">Change Password</button>
                  </form>
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


 

