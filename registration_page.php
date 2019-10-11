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
<h1 colspan='4' align="center">Register</h1>

	  <div id="login-page">
	  	<div class="container">
<?php
if (empty($_POST["username"]))
{
?>
<form method="post" action="registration_page.php" class="head">
<h2 class="form-login-heading">sign up now</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
		            <br>
		            <input type="password" class="form-control" placeholder="Password" name="password" required autofocus>
		            <br>
		            <input type="password" class="form-control" placeholder="Comfirm Password" name="Confirm_pw" required autofocus>
		            <label class="checkbox">
		                <span class="pull-right">
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" type="submit" value="login" name="Action"><i class="fa fa-lock"></i> SIGN UP</button>
                     <label class="checkbox">
		                <span class="pull-right">
		                </span>
		            </label>

                    <input type="Reset" class="btn btn-theme btn-block" Value="Clear Form Fields" style="background-color: orange">
		      </form>
</body>
</html>



<?php
}
else {
    include("connection.php");
    $dsn= "mysql:host=$Host;dbname=$DB";
    $dbh= new PDO($dsn, $Uname, $Pword);
    $password = hash('sha256', $_POST["password"]);
    $Confirm_pw = hash('sha256', $_POST["Confirm_pw"]);
    if($password == $Confirm_pw){

        $query = "INSERT INTO admin (Username, Password) VALUES (NULLIF('$_POST[username]', ''), NULLIF('$password', ''))";

        $stmt = $dbh->prepare($query);
        if(!$stmt->execute())
        {
            $err= $stmt->errorInfo();
            echo "Error adding record to database – contact System Administrator
    Error is: <b>".$err[2]."</b>";
        }
        else {
            echo 'Sign up successfully!';
            }?>
<a href="login.php">
        <button data-dismiss="modal" class="btn btn-default" type="button">Return to Login</button></a>
<?php
    }
    else{
        echo 'Password not same, please Re-enter';?>
                        <p align="left">   <br />
                    <input type="button" value="Go Back" class="btn btn-primary" OnClick="window.location='registration_page.php'">
                </p>
                <?php
    }
    ?>

<?php
}
?>