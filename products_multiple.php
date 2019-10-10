<?php
ob_start();
include('session.php');
include('nav.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="assets/css/table-responsive.css" rel="stylesheet">
    <title>Products</title>
</head>

<body>
<?php
include("connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh= new PDO($dsn, $Uname, $Pword);

?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Products</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i> Multiple Products Table</h4>
                    <section id="unseen">
                        <?php
                        if(empty($_POST["check"]))
                        {
                        $stmt = $dbh->prepare("SELECT * FROM product ORDER BY Name");
                        $stmt->execute();
                        ?>
                        <form method="post" action="products_multiple.php">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <tr>
                                <th>Select</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Purchase Price ($)</th>
                                <th>Sale Price ($)</th>
                                <th>Country of Origin</th>

                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            while($row = $stmt->fetch())
                            {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="check[]" value="<?php echo $row["ID"]; ?>"></td>
                                    <td><?php echo $row["ID"]; ?></td>
                                    <td><?php echo $row["Name"]; ?></td>
                                    <td><input type="text" size="20" name="<?php echo $row["ID"]."a"; ?>" value="<?php echo $row["Purchase_Price"]; ?>"></td>
                                    <td><input type="text" size="20" name="<?php echo $row["ID"]; ?>" value="<?php echo $row["Sale_Price"]; ?>"></td>
                                    <td><?php echo $row["Country_of_Origin"]; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                            <p align="left">
                            <input type="submit" value="Update Selected Rows" class="btn btn-primary">
                            </p>
                        </form>
                    </section>
                </div><!-- /content-panel -->
            </div><!-- /col-lg-4 -->
        </div><!-- /row -->

    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->
<?php include('footer.php');

}
else {
    foreach ($_POST["check"] as $item) {
        $PurchasePrice=$_POST[$item."a"];
        $query = "UPDATE product set Purchase_Price=$PurchasePrice, Sale_Price = $_POST[$item] WHERE ID ='$item'";
        $stmt = $dbh->prepare($query);
        $namestring="SELECT * FROM product WHERE ID ='$item'";
        $rowstmt = $dbh->prepare($namestring);
        $rowstmt->execute();
        $row=$rowstmt->fetchObject();?>
        <p></p>        <p></p>
<h4><?php
        echo "Updating $row->Name ---->   ";
        ;?>

<?php
//        echo the updated product name
        if ($stmt->execute()) {?>
            <a style="color: green">
    <?php echo "Products $row->Name successfully Updated";?></a>
<?php
        }
        else{
                $err= $stmt->errorInfo();?>

            <a style="color: red"><?php
                echo "Error adding record to database – contact System Administrator
                    Error is: <b>".$err[2]."</b>"; ?>            </h4>

            </a>

<?php
        break;}
        $rowstmt->closeCursor();
    }?>
<div>
    <p></p>
    <button class="btn btn-primary" onclick="goBack()">Go Back</button>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</div>
<?php
}
$stmt->closeCursor();


?>
</body>
</html>