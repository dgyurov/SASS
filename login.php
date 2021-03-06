<?php

session_start();

if(isset($_POST['submit'])) {

    // Login
    if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        include_once('backend/Qry.php');
        $result = Qry::q('SELECT id, email, password FROM users WHERE email="'.$email.'"');
        $hashedPassFromDB = $result[0]['password'];

        if (password_verify($password, $hashedPassFromDB)) {
            // Update the current session id with a newly generated one. Session hijacking prevention.
            session_regenerate_id();
            include_once('backend/getip.php');
            $_SESSION["login"] = [ "logged_in" => TRUE, "email" => $email, "id" => $result[0]['id'], "ip" => getUserIP() ];
            header("Location: index.php");
            die;
        } else {
            $_SESSION["wrongpass"] = true;
            $_SESSION['message'] = 'Username/password incorrect!';
            header("Location: logout.php");
            die;
        }
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

    <title>Login to Securitay</title>

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
		.signup-message{
			font-size: 14px;
			font-weight: bold;
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
      <script src="resources/js/jquery.min.js"></script>
  </head>

  <body>

    <div class="container">



      <form class="form-signin" action="login.php" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
          <?php
              if(isset($_SESSION['message'])) {
                  echo '<div class="alert alert-info message"><strong></strong> ' . $_SESSION['message'] . '</div>';
              }
              unset($_SESSION['message']);
          ?>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
		<a href="signup.php" class="signup-message">You don't have an account yet?</a>
        <button class="btn btn-lg btn-success btn-block" type="submit" name="submit">Login</button>
      </form>

    </div>

    <script>
        $(function() {
            $(document).ready(function() {
                $(".message").delay(5000).slideUp();
            });
        });
    </script>

  </body>
</html>