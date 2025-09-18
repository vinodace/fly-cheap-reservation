<?php
  $rootPath = $_SERVER['DOCUMENT_ROOT'] . "/ace-digital-solution/projects/September/flycheapreservation.com/";

 

?>
<?php include("register_form_fetch.php"); ?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>My Account</title>
<?php //echo BASE_URL; ?>

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
            <h2 class="my_account-title pb-3"><?php echo "Welcome, " . htmlspecialchars($_SESSION['user_name']); ?></h2>
            <div class="my_account-box">
              <div class=" my_account-box-leftline"></div>
              <div class="row">
                <div class="col">
                  <h2 class="my_account-title pb-2">My Profile</h2>    
                  <p class="my_account-subtitle">Basic info for a baster booking experience</p>    
                </div>
              </div>
              <ul class="my_account-detail">
                <li>
                  <div class="my_account-detail-hding">Name</div>
                  <div class="my_account-detail-info"><?php echo htmlspecialchars($_SESSION['user_name']); ?></div>
                </li>
                <li>
                  <div class="my_account-detail-hding">Gender</div>
                  <div class="my_account-detail-info"><?= !empty($user['gender']) ? htmlspecialchars($user['gender']) : '-' ?></div>
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

            <div class="my_account-box">
              <div class=" my_account-box-leftline"></div>
              <div class="row">
                <div class="col">
                  <h2 class="my_account-title pb-2">Address Info</h2>    
                  <p class="my_account-subtitle">Basic info for a baster booking experience</p>    
                </div>
                <?php if (!empty($user['address_1']) || !empty($user['address_2']) || !empty($user['country']) || !empty($user['state']) || !empty($user['city']) || !empty($user['zipcode'])): ?>
                  <div class="col-auto">
                    <a href="javascript:void(0)" class="my_account-edit-btn" id="editAddressBtn">
                      <i class="fas fa-pencil-alt"></i> Edit Address
                    </a>
                  </div>
                <?php endif; ?>
              </div>
              <?php if (!empty($user['address_1']) || !empty($user['address_2']) || !empty($user['country']) || !empty($user['state']) || !empty($user['city']) || !empty($user['zipcode'])): ?>
                <ul class="my_account-detail" id="addressDetail">
                  <li>
                    <div class="my_account-detail-hding">Address</div>
                    <div class="my_account-detail-info">
                      <?= htmlspecialchars(trim(($user['address_1'] ?? '') . ' ' . ($user['address_2'] ?? ''))) ?>
                    </div>
                  </li>
                  <li>
                    <div class="my_account-detail-hding">Country</div>
                    <div class="my_account-detail-info"><?= htmlspecialchars($user['country'] ?? '') ?></div>
                  </li>
                  <li>
                    <div class="my_account-detail-hding">State</div>
                    <div class="my_account-detail-info"><?= htmlspecialchars($user['state'] ?? '') ?></div>
                  </li>
                  <li>
                    <div class="my_account-detail-hding">City</div>
                    <div class="my_account-detail-info"><?= htmlspecialchars($user['city'] ?? '') ?></div>
                  </li>
                  <li>
                    <div class="my_account-detail-hding">Zipcode</div>
                    <div class="my_account-detail-info"><?= htmlspecialchars($user['zipcode'] ?? '') ?></div>
                  </li>
                </ul>
              <?php endif; ?>

               <!-- ✅ Address Form (hidden if address already exists) -->
                <form method="post" id="addressForm" style="<?= (!empty($user['address_1']) || !empty($user['address_2']) || !empty($user['country']) || !empty($user['state']) || !empty($user['city']) || !empty($user['zipcode'])) ? 'display:none;' : '' ?>">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-gropu mb-3">
                        <label class="form-lbl">Address 1</label>
                        <input type="text" name="address_1" class="form-field" value="<?= htmlspecialchars($user['address_1'] ?? '') ?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-gropu mb-3">
                        <label class="form-lbl">Address 2</label>
                        <input type="text" name="address_2" class="form-field" value="<?= htmlspecialchars($user['address_2'] ?? '') ?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-gropu mb-3">
                        <label class="form-lbl">Country</label>
                        <input type="text" name="country" class="form-field" value="<?= htmlspecialchars($user['country'] ?? '') ?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-gropu mb-3">
                        <label class="form-lbl">State</label>
                        <input type="text" name="state" class="form-field" value="<?= htmlspecialchars($user['state'] ?? '') ?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-gropu mb-3">
                        <label class="form-lbl">City</label>
                        <input type="text" name="city" class="form-field" value="<?= htmlspecialchars($user['city'] ?? '') ?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-gropu mb-3">
                        <label class="form-lbl">Zipcode</label>
                        <input type="text" name="zipcode" class="form-field" value="<?= htmlspecialchars($user['zipcode'] ?? '') ?>">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <?= isset($msg) ? $msg : '' ?>

                      <div class="d-flex justify-content-end">
                        <button type="submit" class="wrap-btn_web1" name="submit">Save Address</button>
                      </div>  
                    </div>
                  </div>
                </form>
                
                <!-- Show UL if Address exists -->
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<?php include($rootPath . "footer.php"); ?>


 <!-- ✅ JS Toggle -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  const editBtn = document.getElementById("editAddressBtn");
  const addressForm = document.getElementById("addressForm");
  const addressDetail = document.getElementById("addressDetail");

  if (editBtn) {
    editBtn.addEventListener("click", () => {
      addressForm.style.display = "block";   // show form
      addressDetail.style.display = "none"; // hide address details
    });
  }
});
</script>

