<?php
  session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Track Flight Status</title>

  <?php include("header.php"); ?>

<section class="py-5">
  <div class="container">
    <div class="row align-items-center">
      
      <div class="col-md-6">
        <h1 class="wrap-hding_web1 pb-2">Check Live Flight Status Worldwide at Your Fingertips</h1>
        <p class="wrap-prgh_web1 pb-4">
          Access live flight status from airlines across the globe. Whether you're flying today or meeting someone at the airport, get accurate, real-time updates for peace of mind.
        </p>
        <div class="serch-number-box mb-4">
          <div class="d-block d-sm-flex my-2">
            <input type="text" id="flightName" class="form-control field-right-radius-0 mb-2 mb-sm-0" placeholder="Flight Name">
            <input type="text" id="flightNumber" class="form-control field-left-radius-0 mb-2 mb-sm-0" placeholder="Flight No. e.g AB123">
            <button id="searchBtn" class="btn btn-success ms-sm-1 rounded-pill">Search</button>
          </div>
        </div> 

        <div id="flightStatusContainer"></div>
        
      </div>
      <div class="col-md-6">
        <img src="images/flight-status.png" alt="" class="img-fluid">
      </div>
    </div>
  </div>
</section>


<section class="pb-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        
      </div>
      <div class="col-md-12">
        
        <div class="table-responsive"> 
          <table class="table table-striped track-flight-table" id="myTable">
            <thead>
              <tr>
                <th width="130">Flight Logo</th>
                <th width="200">Flight Name</th>
                <th width="150">Flight Number</th>
                <th>From</th>
                <th>To</th>
                <th width="100">Duration</th>
                <!-- <th>Flight Status</th> -->
              </tr>
            </thead>
            <tbody>
              <?php  
                $queryString = http_build_query([
                    //'access_key' => 'db14a49eed808c8331639ca8a2261044' // vk key
                    'access_key' => '6cc9d9869a1d27a2ce11758221fa382f' // geteaway key
                ]);

                $ch = curl_init(sprintf('%s?%s', 'https://api.aviationstack.com/v1/flights', $queryString));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $json = curl_exec($ch);
                if ($json === false) {
                    echo '<tr><td colspan="4">Curl error: ' . curl_error($ch) . '</td></tr>';
                }
                curl_close($ch);

                $api_result = json_decode($json, true);

                function formatTime($iso) {
                    if (!$iso) return 'N/A';
                    $dt = new DateTime($iso, new DateTimeZone('UTC'));
                    return $dt->format("d M, h:i A") . ' ';
                }

                function calculateDuration($departure_iso, $arrival_iso) {
                    if ($departure_iso && $arrival_iso) {
                        $departure = new DateTime($departure_iso);
                        $arrival = new DateTime($arrival_iso);
                        $interval = $departure->diff($arrival);
                        $hours = $interval->h + ($interval->days * 24);
                        $minutes = $interval->i;

                        return sprintf("%d hr %02d min", $hours, $minutes);
                    } else {
                        return "N/A";
                    }
                }

                if (isset($api_result['data']) && is_array($api_result['data'])) {
                  foreach ($api_result['data'] as $flight) {
                      if (isset($flight['live']) && is_array($flight['live']) && isset($flight['live']['is_ground'])) {
                          $is_ground = $flight['live']['is_ground'];
                          $status_text = $is_ground === false ? "In the Air ✈️" : "On the Ground 🛬";
                      } else {
                          $status_text = "Live Status Not Available ❌";
                      }

                      $airline_name = $flight['airline']['name'] ?? 'Unknown Airline';
                      $airline_iata = $flight['airline']['iata'] ?? '';
                      
                      // Airline Logo from CDN without Watermark
                      $airline_logo = $airline_iata ? "https://static.tripcdn.com/packages/flight/airline-logo/latest/airline_logo/3x/". strtolower($airline_iata) .".png" : ''; 

                      // Airline logo from API with watermark
                      // $airline_logo = $airline_iata ? "https://content.airhex.com/content/logos/airlines_{$airline_iata}_40_40_f.png?apikey=VDjfGgv8mxiTvvLLwGicD6V2eq" : ''; 

                      // Airline logo From local Machine
                      /* $airline_logo = $airline_iata ? "starter-pack/kit/Images/Airline-Logos/Tail-Flipped/{$airline_iata}.png" : ''; */

                      
                      
                      $flight_number = $flight['flight']['iata'] ?? 'Unknown Flight';

                      $from = $flight['departure']['airport'] ?? 'Unknown Airport';
                      $from_code = $flight['departure']['iata'] ?? 'N/A';
                      $departure_time = formatTime($flight['departure']['scheduled'] ?? null);
                      $departure_iso = $flight['departure']['scheduled'];

                      $to = $flight['arrival']['airport'] ?? 'Unknown Airport';
                      $to_code = $flight['arrival']['iata'] ?? 'N/A';
                      $arrival_time = formatTime($flight['arrival']['scheduled'] ?? null);
                      $arrival_iso = $flight['arrival']['scheduled'];

                      $total_duration = calculateDuration($departure_iso, $arrival_iso);

                      echo "<tr>";
                      echo "<td><img src='{$airline_logo}' alt='{$airline_name} Logo' width='40'></td>";
                      echo "<td><strong>{$airline_name}</strong></td>";
                      echo "<td>{$flight_number}</td>";
                      echo "<td>{$from} ({$from_code})<br><small><span class='fw-bold'>Departure:</span> {$departure_time}</small> </td>";
                      echo "<td>{$to} ({$to_code})<br><small><span class='fw-bold'>Arrival:</span> {$arrival_time}</small></td>";
                      echo "<td>{$total_duration}</td>";
                      // echo "<td><span>{$status_text}</span></td>";
                      echo "</tr>";
                  }
                } else {
                    echo "<tr><td colspan='4'>No flight data available or API request failed.</td></tr>";
                }
              ?>
            </tbody>
          </table>    
        </div>   
      </div>
    </div>
  </div>
</section>
<section class="pb-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="wrap-subhding_web1 pb-3">Flight Status and Live Tracker</h3>
        <p class="wrap-prgh_web1">
          Stay informed in real-time with our Flight Status and Live Tracker tool. Whether you're a traveler, a loved one picking someone up from the airport, or simply monitoring flight activity, our system provides accurate and up-to-date flight information from around the world.<br><br>

          With just a few clicks, you can track any commercial flight’s departure and arrival times, delays, gate changes, and real-time location—all on a live map. Our tracker pulls data from trusted aviation sources to ensure you get the most reliable flight status updates available.<br><br>

          You can search by flight number, airline, or even by departure and arrival cities. This makes it easy to find flights quickly—no more guessing or waiting endlessly for updates. Get alerts on late departures, early arrivals, and weather-related delays that could impact your plans.<br><br>

          Whether you're flying domestically or internationally, our live flight tracker gives you full visibility from takeoff to touchdown. Never miss a flight detail again—track your journey or someone else's flight with confidence and ease.
        </p>
      </div>
    </div>
  </div>
</section>


<?php include("footer.php"); ?>

 
 <!-- Flight status design on search -->
<script>
  function formatTimeUTC(dateStr) {
  if (!dateStr) return 'N/A';
  const date = new Date(dateStr);
  let timeString = date.toLocaleString('en-GB', {
    day: '2-digit',
    month: 'short',
    hour: '2-digit',
    minute: '2-digit',
    hour12: true,
    timeZone: 'UTC'
  });

  // Force AM/PM to uppercase
  return timeString.replace(/\b(am|pm)\b/i, match => match.toUpperCase()) + ' ';
 }

  function calculateDuration(start, end) {
    if (!start || !end) return 'N/A';
    const d1 = new Date(start);
    const d2 = new Date(end);
    const diffMs = Math.abs(d2 - d1);
    const hours = Math.floor(diffMs / 3600000);
    const mins = Math.floor((diffMs % 3600000) / 60000);
    return `${hours} hr ${mins} min`;
  }

  document.getElementById('searchBtn').addEventListener('click', function () {
    const nameInput = document.getElementById('flightName').value.trim().toLowerCase();
    const numberInput = document.getElementById('flightNumber').value.trim().toLowerCase();
    const container = document.getElementById('flightStatusContainer');
    container.innerHTML = '';

    if (!nameInput && !numberInput) {
      container.innerHTML = '<p class="text-danger">Please enter flight name or number.</p>';
      return;
    }

    let matchFound = false;

    flightData.forEach(flight => {
      const airlineName = (flight.airline?.name || '').toLowerCase();
      const flightNum = (flight.flight?.iata || '').toLowerCase();

      if ((airlineName.includes(nameInput) || !nameInput) &&
          (flightNum.includes(numberInput) || !numberInput)) {

        matchFound = true;

        const from = flight.departure?.airport || 'Unknown';
        const fromCode = flight.departure?.iata || '';
        const fromTime = formatTimeUTC(flight.departure?.scheduled);
        const fromISO = flight.departure?.scheduled;

        const to = flight.arrival?.airport || 'Unknown';
        const toCode = flight.arrival?.iata || '';
        const toTime = formatTimeUTC(flight.arrival?.scheduled);
        const toISO = flight.arrival?.scheduled;

        const duration = calculateDuration(fromISO, toISO);
        const logo = flight.airline?.iata ? `https://static.tripcdn.com/packages/flight/airline-logo/latest/airline_logo/3x/${flight.airline.iata.toLowerCase()}.png` : '';

        const html = `
        <div class="flight-status-box mt-3">
          <div class="flight-status-top">
            <img src="${logo}" alt="" class="flight-logo">
            <p class="flight-number">${flight.airline.name}<span> Flight Number : ${flight.flight.iata}</span></p>
          </div>
          <div class="flight-fetch-details">
            <div class="airport-details">
              <div>
                <p class="airport-name">${from}</p>
                <h2 class="airport-code">(${fromCode})</h2>
              </div>
              <div>
                <p class="airport-name text-end">${to}</p>
                <h2 class="airport-code text-end">(${toCode})</h2>
              </div>
            </div>
            <div class="progress mt-4 custom-progress">
              <div class="progress-bar progress-bar-striped bg-success" style="width: 100%"></div>
              <div class="check-in-icon">
                <i class="fa-solid fa-plane-departure"></i>
              </div>
              <div class="check-out-icon">
                <i class="fa-solid fa-plane"></i>
              </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
              <div>
                <p class="departure-title">Departure</p>
                <h2 class="departure-date">${fromTime}</h2>
              </div>
              <div class="d-none d-md-block">
                <p class="duration-title">Duration</p>
                <p class="duration-time">${duration}</p>
              </div>
              <div>
                <p class="departure-title text-end">Arrival</p>
                <h2 class="departure-date text-end">${toTime}</h2>
              </div>
            </div>
            <div class="d-flex justify-content-center align-items-center d-md-none mt-3">
              <p class="duration-title mb-0">Duration</p>
              <p class="duration-time ms-2">${duration}</p>
            </div>
          </div>
        </div>`;

        container.insertAdjacentHTML('beforeend', html);
      }
    });

    if (!matchFound) {
      container.innerHTML = '<div class="alert alert-warning mt-2">No matching flight found.</div>';
    }
  });
</script>



<script>
  const flightData = <?php echo json_encode($api_result['data']); ?>;
</script>

<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
<script>
  /*var table = new DataTable('#myTable');
 
var filteredData = table
    .columns([0, 1])
    .data()
    .flatten()
    .filter(function (value, index) {
        return value > 20 ? true : false;
    });*/
    $('#myTable').DataTable({
      pageLength: 25
    });
</script>