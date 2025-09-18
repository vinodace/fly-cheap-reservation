<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//session_start();
include 'includes/db_connect.php'; // Your DB connection

$message = "";

// Handle login/signup form submission
if (isset($_POST['submit']) && !empty($_POST['email'])) {
    $email = trim($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if user exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // User exists -> login
            $_SESSION['user_email'] = $email;
            $message = "✅ Welcome back!";
        } else {
            // User doesn't exist -> register
            $stmt_insert = $conn->prepare("INSERT INTO users (user_email) VALUES (?)");
            $stmt_insert->bind_param("s", $email);
            $stmt_insert->execute();
            $_SESSION['user_email'] = $email;
            $message = "✅ Email registered successfully!";
        }
        $stmt->close();
    } else {
        $message = "⚠️ Invalid email address.";
    }
}
?>


<?php
	$baseURL = '/ace-digital-solution/projects/September/flycheapreservation.com/';
    $rootPath = $_SERVER['DOCUMENT_ROOT'] . "/ace-digital-solution/projects/September/flycheapreservation.com/";

?>

<?php 
	$phone_web = "+1-800-123-4567";
	$email_web = "support@domainname.com";
	$domainname_web_url_web ="domainname.com";
	$domainname_web = "domainname";

	// at index page add class in header
  /*$headerClass = '';
  if (basename($_SERVER['SCRIPT_NAME']) === 'index.php') {
    $headerClass = 'header-pos';
  }
  else {
  	$headerClass = 'header-nav';
  }*/

    $headerClass = 'header-nav';

    // Check if we are in the project root index.php (not in subfolder)
    if (basename($_SERVER['SCRIPT_NAME']) === 'index.php' && dirname($_SERVER['SCRIPT_NAME']) === '/') {
        $headerClass = 'header-pos';
    }
?>



<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- <meta name="robots" content="noindex, nofollow"> -->
	<!-- Favicon icon -->
    <link rel="shortcut icon" type="image/png" href="<?= $baseURL ?>images/favicon.png"> 
    <!-- Custom css -->
    <link rel="stylesheet" type="text/css" href="<?= $baseURL ?>css/style.css">
    <!-- Bootstrap v5.0 -->
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- Owl Carousel v2.3.4 -->
    <link rel="stylesheet" type="text/css" href="<?= $baseURL ?>css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?= $baseURL ?>css/owl.theme.default.min.css">
    <!-- Font Awesome Free 6.7.2 -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	
</head>
<body>
<header class="<?= $headerClass ?>"> 
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light navleft_right-pading">
		    <a  href="<?= $baseURL ?>">
		    	<img src="<?= $baseURL ?>images/logo.png" alt="" class="logo">
		    </a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    	<?php
                      $nav1=$nav2=$nav3=$nav4=$nav5="";
                      $tt=explode("/",$_SERVER['PHP_SELF']);
                      $len=count($tt)-1;
                      $cur_page=$tt[$len];
                      switch($cur_page)
                      {
                      case "index.php":
                      $nav1='active';
                      break;
                      case "flight-status.php":
                      $nav2='active';
                      break;
                      case "destination.php":
                      $nav3='active';
                      break;
                      case "packages.php":
                      $nav4='active';
                      break;
                      case "about-us.php":
                      $nav5='active';
                      break;
                      case "contact-us.php":
                      $nav6='active';
                      break;
                      }
                ?>
		      <ul class="navbar-nav mx-auto">
			      <li class="nav-item">
			        <a class="nav-link <?php echo $nav1; ?>" href="<?= $baseURL ?>">Flights</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link <?php echo $nav2; ?>" href="<?= $baseURL ?>flight-status.php">Track Flights Status</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link <?php echo $nav3; ?>" href="<?= $baseURL ?>destination.php">Destination</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link <?php echo $nav4; ?>" href="<?= $baseURL ?>packages.php">Packages</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link <?php echo $nav5; ?>" href="<?= $baseURL ?>about-us.php">About Us</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link <?php echo $nav6; ?>" href="<?= $baseURL ?>contact-us.php">Contact Us</a>
			      </li>
		      </ul>
		      <!-- <a href="javascript:void(0)" class="header-btn_web1" data-bs-toggle="modal" data-bs-target="#login_signup-modal">Sign in / Register</a> -->
		      <?php if (isset($_SESSION['user_email'])): ?>
              <div class="dropdown d-inline-block">
                  <a href="javascript:void(0)" class="header-btn_web1 dropdown-toggle" data-bs-toggle="dropdown">
                      <?= "Hi, " . htmlspecialchars($_SESSION['user_name'] ?? $_SESSION['user_email']) ?>
                  </a>
                  <ul class="dropdown-menu my_account-dropdown">
                      <!-- <li><a class="dropdown-item" href="<?= $baseURL ?>my-account/"><i class="fa-solid fa-user"></i> My Profile</a></li> -->
                      <li><a class="dropdown-item" href="<?= $baseURL ?>my-account/"><i class="fa-solid fa-user"></i> My Profile</a></li>
                      <li><a class="dropdown-item" href="<?= $baseURL ?>my-account/bookings.php"><i class="fa-solid fa-ticket"></i> My Bookings</a></li>
                      <li><a class="dropdown-item" href="<?= $baseURL ?>logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                  </ul>
              </div>
                <?php else: ?>
                      <a href="javascript:void(0)" class="header-btn_web1" data-bs-toggle="modal" data-bs-target="#login_signup-modal">
                          Login / Register
                      </a>
                <?php endif; ?>
		    </div>
		</nav>
	</div>	
</header>
<!-- Header -->

<?php if (!empty($message)): ?>
    <div class="signup-account-msg"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php include($rootPath . "breadcrumb.php") ?>