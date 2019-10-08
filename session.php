<?php
session_start();
include("connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh= new PDO($dsn, $Uname, $Pword);
$stmt = $dbh->prepare("select * from admin");
$stmt->execute();
$row = $stmt->fetch();

$username = $row['Username'];
if(!isset($_SESSION['username'])){
    header('location: login.php');

}?>
