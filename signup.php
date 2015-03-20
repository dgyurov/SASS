<?php

session_start();

if(isset($_POST['submit'])) {

    // Create new user
    if (isset($_POST['email-signup']) && !empty($_POST['email-signup']) && isset($_POST['password-signup']) && !empty($_POST['password-signup'])) {
        $email = trim($_POST['email-signup']);
        $password = trim($_POST['password-signup']);

        include_once('backend/Qry.php');
        $result = Qry::create_user($email, $password);
        $_SESSION['message'] = 'Please login with your new user.';
        header('Location: login.php');
        die;
    }
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

    <title>Signup to Securitay</title>

    <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="resources/style/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <style>
    	body {
		  padding-top: 40px;
		  padding-bottom: 40px;
		  background-color: #eee;
		}
		
		.form-signin {
		  max-width: 330px;
		  padding: 15px;
		  margin: 0 auto;
		}
		.form-signin .form-signin-heading,
		.form-signin .checkbox {
		  margin-bottom: 10px;
		}
		.form-signin .checkbox {
		  font-weight: normal;
		}
		.form-signin .form-control {
		  position: relative;
		  height: auto;
		  -webkit-box-sizing: border-box;
		     -moz-box-sizing: border-box;
		          box-sizing: border-box;
		  padding: 10px;
		  font-size: 16px;
		}
		.form-signin .form-control:focus {
		  z-index: 2;
		}
		.form-signin input[type="email"] {
		  margin-bottom: -1px;
		  border-bottom-right-radius: 0;
		  border-bottom-left-radius: 0;
		}
		.form-signin input[type="password"] {
		  margin-bottom: 10px;
		  border-top-left-radius: 0;
		  border-top-right-radius: 0;
		}
		.container{
			text-align: center;
		}
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="resources/js/html5shiv.min.js"></script>
      <script src="resources/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="signup.php" method="post">
        <h2 class="form-signin-heading">Sign up for free!</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email-signup" id="email-signup" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password-signup" id="password-signup" class="form-control" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign up</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>