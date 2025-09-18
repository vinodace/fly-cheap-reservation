<?php
  $rootPath = $_SERVER['DOCUMENT_ROOT'] . "/";

?>
<?php
include("register_form_fetch.php");


// Fetch recent flight searches for this user
$sql = "
    SELECT origin, origin_name, destination, destination_name,
           departure_date, return_date, passenger, travel_class, created_at
    FROM flight_search
    WHERE user_id = ?
    ORDER BY created_at DESC
    LIMIT 5
";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("❌ SQL error (flight_search): " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$recent_searches = [];
while ($row = $result->fetch_assoc()) {
    $recent_searches[] = $row;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>My Activities</title>

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
                  <h2 class="my_account-title pb-2">My Activities</h2>    
                  <p class="my_account-subtitle">Quickly revisit your recent flight searches to find the best options and continue booking without starting over.</p>    
                </div>
                <div class="w-100 mt-3"></div>
                  <div class="recent-searches">
                    <h3 class="wrap-subhding_web1 mb-3">Recent Flight Searches</h3>
                    <?php if (!empty($recent_searches)): ?>
                        <ul class="rec_flight_srch">
                            <?php foreach ($recent_searches as $search): ?>
                                <li>
                                    ✈️ <strong><?php echo htmlspecialchars($search['origin_name']); ?></strong> (<?php echo htmlspecialchars($search['origin']); ?>) 
                                    ➝ <strong><?php echo htmlspecialchars($search['destination_name']); ?></strong> (<?php echo htmlspecialchars($search['destination']); ?>) <br>
                                    📅 Departure: <?php echo htmlspecialchars($search['departure_date']); ?>
                                    <?php if (!empty($search['return_date'])): ?>
                                        | Return: <?php echo htmlspecialchars($search['return_date']); ?>
                                    <?php endif; ?>
                                    <br>
                                    👥 Passengers: <?php echo htmlspecialchars($search['passenger']); ?> |
                                    🎟 Class: <?php echo htmlspecialchars($search['travel_class']); ?> <br>
                                    ⏱ Searched on: <?php echo htmlspecialchars($search['created_at']); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="wrap-prgh_web1 text-danger">No recent flight searches found.</p>
                    <?php endif; ?>
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


 

