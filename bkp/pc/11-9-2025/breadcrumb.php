

<?php

$baseURL = "/ace-digital-solution/projects/September/flycheapreservation.com/"; 

// Get current file name (like index.php, about.php, etc.)
$currentFile = basename($_SERVER['PHP_SELF']);

// Don't show breadcrumb on homepage (index.php or any custom condition)
//if ($currentFile !== 'index.php') {

// List of pages where breadcrumb should NOT be shown
$excludedPages = ['index.php', 'flights.php', 'flight-search.php', 'finalize-booking.php']; // Add more as needed

if (!in_array($currentFile, $excludedPages)) {

  // Generate readable title
  //$currentPage = basename($_SERVER['PHP_SELF'], ".php");

  $currentPage = basename($currentFile, ".php");
  $currentPage = str_replace("-", " ", $currentPage);
  $currentPage = ucwords($currentPage);
?>
<section class="breadcrumb-bg_web1">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <ul class="breadcrumb-ullist_web1">
          <li><a href="<?= $baseURL ?>"><i class="fa-solid fa-house"></i> Home</a></li>
          <li><?php echo $currentPage; ?></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php
}
?>