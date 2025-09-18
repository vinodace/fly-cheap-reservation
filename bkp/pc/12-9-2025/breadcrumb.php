<?php
$baseURL = "/ace-digital-solution/projects/September/flycheapreservation.com"; 

// Pages to exclude (full relative paths from project root)
$excludedPaths = [
    "/",                 // root index.php
    "/index.php",        // explicitly root index.php
    "/flights.php",
    "/flight-search.php",
    "/finalize-booking.php"
];

// Get current path (like /my-account/help-desk.php)
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove project root
if (strpos($path, $baseURL) === 0) {
    $path = substr($path, strlen($baseURL));
}

// ✅ If path is in excluded list, do not show breadcrumb
if (!in_array($path, $excludedPaths)) {
    $pathParts = array_filter(explode('/', $path));
?>
<section class="breadcrumb-bg_web1">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <ul class="breadcrumb-ullist_web1">
          <li><a href="<?= $baseURL ?>/"><i class="fa-solid fa-house"></i> Home</a></li>
          <?php
          $fullPath = $baseURL;
          $i = 0;
          foreach ($pathParts as $part) {
              $fullPath .= '/' . $part;

              // remove .php extension
              $partName = preg_replace('/\.php$/', '', $part);
              $label = ucwords(str_replace(['-', '_'], ' ', $partName));

              if (++$i === count($pathParts)) {
                  echo '<li class="active" aria-current="page">' . $label . '</li>';
              } else {
                  echo '<li><a href="' . $fullPath . '">' . $label . '</a></li>';
              }
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<?php
}
?>
