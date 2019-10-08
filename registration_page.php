<html>
<body>
<h1 colspan='4' align="center">Register</h1>

<?php
if (empty($_POST["username"]))
{
?>
<form method="post" action="registration_page.php" class="head">
<table border= '1px' stye='width:600px;line-height:40px;' align="center" id="id">
    <tbody>
    <tr class="head">
        <th>Username</th>
        <th>Password</th>
        <th>Comfirm PW</th>
    </tr>
    <tr>
            <td><input type="text" size="20" name="username"></td>
            <td><input type="password" size="20" name="password"></td>
            <td><input type="password" size="20" name="Confirm_pw"></td>
     </tr>
    </tbody>
</table>
    <p></p>
    <center>
        <button type="submit" class="btn btn-theme">Sign Up</button>
    <input type="Reset" Value="Clear Form Fields">
    </center>
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
    if($password === $Confirm_pw){

        $query = "INSERT INTO admin (Username, Password) VALUES (NULLIF('$_POST[username]', ''), NULLIF('$password', ''))";
        $stmt = $dbh->prepare($query);
    }
    else{
        echo 'Re-enter';
    }
    if(!$stmt->execute())
    {
        $err= $stmt->errorInfo();
        echo "Error adding record to database – contact System Administrator
    Error is: <b>".$err[2]."</b>";
    }
    else {
        echo 'Sign up successfully!'?>
<a href="login.php">
        <button data-dismiss="modal" class="btn btn-default" type="button">Return to Login</button></a>
<?php
    }
}
?>