<?php
error_reporting(0); // add this before handin

session_start();


if(isset($_POST['submit'])) {
  if(isset($_POST['email-signup']) && !empty($_POST['email-signup']) && isset($_POST['password-signup']) && !empty($_POST['password-signup'])) {
    $email = trim($_POST['email-signup']);
    $password = trim($_POST['password-signup']);
    
    include_once('backend/Qry.php');
    $result = Qry::create_user($email,$password);
  }	

  if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);

    include_once('backend/Qry.php');
    $resultTEST = Qry::q('SELECT id, email, password FROM users WHERE email="'.$email.'"');
    $hashedPassFromDB = $resultTEST[0]['password'];

    if (password_verify($password, $hashedPassFromDB)) {
        $_SESSION["login"] = [ "logged_in" => TRUE, "email" => $email, "id" => $result[0]['id'] ];
    } else {
        $_SESSION["wrongpass"] = true; 
        header("Location: logout.php");
        die;
    }
	}

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

    <title>MyGur</title>

    <!-- Bootstrap core CSS -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="resources/style/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="resources/style/carousel.css" rel="stylesheet">
    <link href="resources/style/lightbox.css" rel="stylesheet" />
    
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
	<script src="resources/js/lightbox.min.js"></script>
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
          <a class="navbar-brand" href="#">Security course</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php?page=pictures">Pictures</a></li>
            <li><a href="index.php?page=upload">Upload</a></li>
            <li><a href="logout.php">Log out (<?php echo $_SESSION['login']['email'] ?>)</a></li>
          </ul>
        </div>
      </div>
    </nav><!-- Fixed navbar END -->

    <div class="container">
      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Picture Heaven</h1>
        <p>Do your worst...</p>
      </div>
      <div class="row">
      	
      	
      	<?php
			$path = 'pages/';
			if(isset($_GET['page']) && !empty($_GET['page'])) {
				if(file_exists($path . $_GET['page']) . '.php') {
					include_once($path . $_GET['page'] . '.php');
				}
			}
			
		?>
      	
      	
      </div>	

    </div> <!-- /container -->


    <script>
		$(function() {
			$(document).ready(function() {
				
				$(".saved").delay(3200).slideUp();
		
			});
		});
	</script>


  </body>
</html>
