<?php
  $rootPath = $_SERVER['DOCUMENT_ROOT'] . "/ace-digital-solution/projects/September/flycheapreservation.com/";

?>
<?php
include("register_form_fetch.php");


// Fetch all passenger details for logged-in user
$stmt = $conn->prepare("SELECT id, first_name, last_name, gender, date_of_birth 
                        FROM passenger_details 
                        WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>My Booking</title>

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
                  <h2 class="my_account-title pb-2">My Booking</h2>    
                  <p class="my_account-subtitle">Quickly revisit your recent flight searches to find the best options and continue booking without starting over.</p>    
                </div>
                <div class="w-100 mt-3"></div>
                
                <h2>My Passengers</h2>
                <table border="1" cellpadding="8" cellspacing="0">
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                  </tr>
                  <?php while ($row = $result->fetch_assoc()) { ?>
                  <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['first_name']) ?></td>
                    <td><?= htmlspecialchars($row['last_name']) ?></td>
                    <td><?= htmlspecialchars($row['gender']) ?></td>
                    <td><?= htmlspecialchars($row['date_of_birth']) ?></td>
                  </tr>
                  <?php } ?>
                </table>  
                
              </div>

            </div>
          </div>  
        </div>
      </div>
    </div>
  </div>
</section>


<?php include($rootPath . "footer.php"); ?>


 

