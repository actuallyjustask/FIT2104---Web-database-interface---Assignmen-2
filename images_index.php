<?php
ob_start();
include('session.php');
include('nav.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="assets/css/table-responsive.css" rel="stylesheet">
    <title>Images</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
        }

        img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }
    </style>

</head>

<body>
<?php
include("connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh= new PDO($dsn, $Uname, $Pword);
$stmt = $dbh->prepare("select * from product_image order by Name");
$stmt->execute();


?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Images</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i> Images Table</h4>
                    <section id="unseen">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image Name</th>
                                <th>Thumbnail</th>
                                <th>Product Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            while($row = $stmt->fetch())
                            {
                                $pid = $row['Product_id'];
                                $productstmt = $dbh->prepare("select * from product where ID=$pid");
                                $productstmt->execute();
                                $productrow= $productstmt->fetch()

                                ?>
                                <tr>

                                    <td><?php echo $row["ID"]; ?></td>
                                    <td><?php echo $row["Name"]; ?></td>
                                    <td>
                                        <a target="_blank" href="product_images/<?php echo $row["Name"]?>">
                                            <img src="product_images/<?php echo $row["Name"]?>" alt="Forest" style="width:150px">
                                        </a></td>
                                    <td><?php echo $productrow["Name"]; ?></td>
                                    <td>
                                        <a href="images_modify.php?ID=<?php echo $row["ID"]; ?>&Action=Update"><button class="btn btn-primary btn-xs">
                                                <i class="fa fa-pencil" title="edit"></i></button>
                                            <a href="images_modify.php?ID=<?php echo $row["ID"]; ?>&Action=Delete"><button class="btn btn-danger btn-xs">
                                                    <i class="fa fa-trash-o " title="delete"></i></button>

                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </section>
                </div><!-- /content-panel -->
            </div><!-- /col-lg-4 -->
        </div><!-- /row -->

        </div><!-- /row -->

    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->
<?php include('footer.php');

$stmt->closeCursor();

?>
</body>
</html>
