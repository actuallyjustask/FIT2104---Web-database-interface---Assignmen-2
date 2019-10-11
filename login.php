<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	<?php
        if(empty($_POST["username"]) || empty($_POST["password"])){
	  	    ?>
		      <form method="post" class="form-login" action="login.php">
		        <h2 class="form-login-heading">sign in now</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
		            <br>
		            <input type="password" class="form-control" placeholder="Password" name="password" required>
		            <label class="checkbox">
		                <span class="pull-right">
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" type="submit" value="login" name="Action"><i class="fa fa-lock"></i> SIGN IN</button>

                    <hr>
		            
		            <div class="login-social-link centered">

		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="registration_page.php">
		                    Create an account
		                </a>
		            </div>
		
		        </div>
                    <hr>
                    <div class="login-social-link centered">

                        <div class="registration">
                            Username: test<br/>
                            Password: 123<br/>
                            <br/>
                            Or you can register.<br/>
                        </div>

                    </div>

		
		      </form>
            <?php
        }
        else {
            include("connection.php");

            $dsn = "mysql:host=$Host;dbname=$DB";
            $dbh = new PDO($dsn, $Uname, $Pword);
            $stmt = $dbh->prepare("SELECT Username, Password FROM admin WHERE username = ? AND password = ?");
            $pword = hash('sha256', $_POST["password"]);

            $stmt->execute([$_POST["username"], $pword]);

            $result = $stmt->fetchObject();
            if (!empty($result)) {
                //Redirect to index.php
                header("location: index.php");
                $_SESSION['username'] = $_POST["username"];
            } else {

            $message = "Sorry, login details incorrect, please Re-enter";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header("Refresh:0.5; url=login.php");                ?>
<?php
            }
        }
        ?>
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/charity-jar-770.jpg", {speed: 500});
    </script>


  </body>
</html>
