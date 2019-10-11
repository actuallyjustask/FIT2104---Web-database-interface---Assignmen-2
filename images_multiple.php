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
                            <?php
                            if(empty($_POST["check"]))
                            {
                            $pistmt = $dbh->prepare("SELECT * FROM product_image ORDER BY Name");
                            $pistmt->execute();

                            ?>
                            <form method="post" action="images_multiple.php">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>ID</th>
                                        <th>Image Name</th>
                                        <th>Thumbnail</th>
                                        <th>Product Name</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <?php
                                    while($row = $stmt->fetch())
                                    {
                                        $pid = $row['Product_id'];
                                        $imagename=$row["Name"];
                                        $productstmt = $dbh->prepare("select * from product where ID=$pid");
                                        $productstmt->execute();
                                        $productrow= $productstmt->fetch()

                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="check[]" value="<?php echo $row["ID"]; ?>"></td>
                                            <td><?php echo $row["ID"]; ?></td>
                                            <td><?php echo $row["Name"]; ?></td>
                                            <td>
                                                <a target="_blank" href="product_images/<?php echo $row["Name"]?>">
                                                    <img src="product_images/<?php echo $row["Name"]?>" alt="Forest" style="width:150px">
                                                </a></td>
                                            <td><?php echo $productrow["Name"]; ?></td>

                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <p align="left">
                                    <input type="submit" value="Delete" class="btn btn-primary">
                                </p>
                            </form>
                        </section>
                    </div><!-- /content-panel -->
                </div><!-- /col-lg-4 -->
            </div><!-- /row -->
        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->

    <?php

    }
    else {
        $row = $stmt->fetch();
        foreach ($_POST["check"] as $item) {
            $del_query = "DELETE FROM product_image WHERE ID ='$item';";
            $select_query = "select * from product_image where ID='$item';";
            $select_img_stmt = $dbh->prepare($select_query);
            $select_img_stmt->execute();
            $sel_img_row = $select_img_stmt->fetch();

            $del_stmt = $dbh->prepare($del_query);
            if ($del_stmt->execute()) {?>
                <a style="color: green">
                    <?php echo "Image ".$sel_img_row['Name']. " successfully Deleted";?><br/></a>

                <?php
                $del_stmt->closeCursor();
            }
            else{
                $err= $del_stmt->errorInfo();?>

                <a style="color: red"><?php
                    echo "Error adding record to database – contact System Administrator
                    Error is: <b>".$err[2]."</b>"; ?>            </h4>

                </a>

                <?php
                break;}

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

    ?>
    </body>
    </html>
<?php
include('footer.php');


$stmt->closeCursor();
?>