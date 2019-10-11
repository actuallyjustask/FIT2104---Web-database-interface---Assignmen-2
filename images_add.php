<?php
ob_start();
include('session.php');
include('nav.php');
include("connection.php");

$productquery="SELECT * FROM product ORDER BY Name";
$productstmt = $dbh->prepare($productquery);
$productstmt->execute();

?>
<html>
<head>
    <title>Images</title>
</head>
<body>

<section id="container" >
    <section id="main-content">
        <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> Images Uploade</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <?php
                    if (!isset($_FILES["userfile"]["tmp_name"]))
                    {
                    ?>
                    <form method="post" enctype="multipart/form-data" action="images_add.php">
                        <div class="form-group">
                            <tr>
                                <div class="col-lg-3">
                                <td><b>Select a file to upload:</b><br><input type="file" size="50" name="userfile" class="btn btn-default"></td>
                                </div>
                            </tr>
                            <tr>
                                    <div class="col-lg-3">
                                        <td><b>Products</b><br>
                                <select class="form-control" name="product">
                                    <?php
                                    while($productrow = $productstmt->fetch())
                                    {

                                    ?>
                                    <tr>
                                        <td>
                                                <span class="check">
                                                    <option name= "product" value="<?php echo $productrow['ID']; ?>"><?php echo $productrow['Name']; ?></option>
                                                </span>

                                        </td>
                                    </tr>
                            <?php }
                            ?>

                        </div>

                        <p align="left">
                            <input type="submit" value="Upload File"  class="btn btn-warning">
                        </p>
                    </form>

                </div>
            </div>

        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->

</section>




<?php
}
else
{
    $upfile = "product_images/".$_FILES["userfile"]["name"];

    if($_FILES["userfile"]["type"] != "image/gif" && $_FILES["userfile"]["type"] != "image/pjpeg" && $_FILES["userfile"]["type"] != "image/jpeg" && $_FILES["userfile"]["type"] != "image/png" && $_FILES["userfile"]["type"] != "image/pdf")
    {
        echo "ERROR: You may only upload .jpg .png or .gif files";
    }
    else
    {
        if(!move_uploaded_file($_FILES["userfile"]["tmp_name"],$upfile))
        {
            echo "ERROR: Could Not Move File into Directory";
        }
        else
        {
            ?><h3 style="color: green">Image Upload Successfully!</h3><?php
            echo "File Name: " .$_FILES["userfile"]["name"]."<br />";
            $imagename="'".$_FILES["userfile"]["name"]."'";
            $dsn= "mysql:host=$Host;dbname=$DB";
            $dbh= new PDO($dsn, $Uname, $Pword);
            $query = "INSERT INTO product_image (Product_id, Name) VALUES ($_POST[product],$imagename)";
            $stmt = $dbh->prepare($query);
            if(!$stmt->execute())
            {
                $err= $stmt->errorInfo(); ?>
                        <h4>
                            <?php
                            echo "Error adding record to database – contact System Administrator
    Error is: <b>".$err[2]."</b>"; ?></h4>
                        <div>
                            <button class="btn btn-default" onclick="goBack()">Go Back</button>
                            <script>
                                function goBack() {
                                    window.history.back();
                                }
                            </script></div>

                <?php
            }
            else {
                $imageid = $dbh->lastInsertId();



                $stmt->closeCursor();
                header("Location: images_index.php");
            }
        }
    }

    $currdir = dirname($_SERVER["SCRIPT_FILENAME"])."/product_images";

    $dir = opendir($currdir);

    echo "<br /><br />";
    echo "<h1>Contents of Uploads Directory</h1>";
    while($file = readdir($dir))
    {
        if($file == "." || $file =="..")
        {
            continue;
        }
        echo $file."<br />";
    }
    closedir($dir);
}
?>
<p align="left">   <br />
    <input type="button" value="Return to List" class="btn btn-theme" style="background-color: darkorange" OnClick="window.location='images_index.php'">
</p>
<?php include('footer.php') ?>
</body>
</html>