<?php
ob_start();
include('session.php');
include('nav.php');
?>
<html>
<head>
    <title>PHP Upload File</title>
</head>
<body>

<section id="container" >
    <section id="main-content">
        <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> PHP File Uploade</h3>
            <div class="row mt">
                <div class="col-lg-12">
                    <?php
                    if (!isset($_FILES["userfile"]["tmp_name"]))
                    {
                    ?>
                    <form method="post" enctype="multipart/form-data" action="upload_image.php">
                        <table border="0">
                            <tr>
                                <td><b>Select a file to upload:</b><br><input type="file" size="50" name="userfile"></td>
                            </tr>
                            <tr>
                                <td><input type="submit" value="Upload File"></td>
                            </tr>
                        </table>
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
            echo "Temporary File Name: " .$_FILES["userfile"]["tmp_name"]."<br />";
            echo "File Name: " .$_FILES["userfile"]["name"]."<br />";
            echo "File Size: " .$_FILES["userfile"]["size"]."<br />";
            echo "File Type: " .$_FILES["userfile"]["type"]."<br />";
            echo '<br />This is the contents of the entire upload array - $_FILES[userfile]<br />';
            var_dump($_FILES["userfile"]);
        }
    }

    $currdir = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads";

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
<?php include('footer.php') ?>
</body>
</html>