<?php
error_reporting(0); // add this before handin

session_start();

// Session hijacking prevention.
// Checks if the IP address in the request is the same as the IP from the login.
include_once('backend/getip.php');
if(getUserIP() != $_SESSION['login']['ip']) {
    header("Location: logout.php");
    die;
}

// Check if user logged in
if(!$_SESSION["login"]["logged_in"]) {
	header("Location: logout.php");
	die;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $_SESSION['login']['email'] ?></title>

    <!-- Bootstrap core CSS -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="resources/style/bootstrap.min.css">

    <!-- Custom styles for this template -->
      <link rel="stylesheet" href="resources/style/carousel.css" />
      <link rel="stylesheet" href="resources/style/bootstrap-glyphicons.css" />
    <style>
    	body {
		  padding-top: 70px;
		  padding-bottom: 30px;
		}
		
		.theme-dropdown .dropdown-menu {
		  position: static;
		  display: block;
		  margin-bottom: 20px;
		}
		
		.theme-showcase > p > .btn {
		  margin: 5px 0;
		}
		
		.theme-showcase .navbar .container {
		  width: auto;
		}
    </style>
    
    <script src="resources/js/jquery.min.js"></script>
	<script src="resources/js/bootstrap.min.js"></script>
  </head>
<!-- NAVBAR
================================================== -->
 
  <body role="document">

    <!-- Fixed navbar START -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">SAS</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php?page=pictures">Picture gallery</a></li>
            <li><a href="index.php?page=upload">Upload picture</a></li>
            <li><a href="logout.php">Log out (<?php echo $_SESSION['login']['email'] ?>)</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
        <?php
            $path = 'pages/';
            if(isset($_GET['page']) && !empty($_GET['page'])) {
                if(file_exists($path . $_GET['page']) . '.php') {
                    include_once($path . $_GET['page'] . '.php');
                }
            } else {
                include_once('pages/home.php');
            }
        ?>
    </div>
    <script>
		$(function() {
			$(document).ready(function() {
				$(".saved").delay(5000).slideUp();
			});
		});
	</script>
  </body>
</html>
