<?php
ob_start();

//include('nav.php');
require "vendor/autoload.php";
include("connection.php");
include("CreatePDF.php");
?>

<html>
<head>
    <title>PHP PDF Creation</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<h1>Create PDF</h1>
<?php
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh = new PDO($dsn,$Uname,$Pword);

$stmt = $dbh->prepare("SELECT * FROM client ORDER BY Lname");
$stmt->execute();
$allRows=$stmt->fetchAll(PDO::FETCH_ASSOC);

//Column titles
$header = array('ID', 'FName', 'Lname', 'Address','Email','Mobile');
//Column Widths
$headerWidth=array(50,150,100,300,200,100);

//create new instance of my CreatePDF class
$PDF = new CreatePDF();

//pass it headers, headerWidth and data
$table = $PDF->CustomerPDF($header, $headerWidth, $allRows);


echo $table;
echo "<br />";
echo "<a href='PDFS/clients_export.pdf'>Click here to see PDF</a>";
echo "<br />";
//echo dirname($_SERVER["SCRIPT_FILENAME"]);
header("location=PDFS/clients_export.pdf");
?>

</body>
</html>