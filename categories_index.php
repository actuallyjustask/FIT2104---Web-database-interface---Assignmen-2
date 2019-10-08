<?php
ob_start();
include('session.php');
include('nav.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="assets/css/table-responsive.css" rel="stylesheet">
    <title>Categories</title>
</head>

<body>
<?php
include("connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh= new PDO($dsn, $Uname, $Pword);
$stmt = $dbh->prepare("select * from category");
$stmt->execute();
?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Categories</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i> Categories Table</h4>
                    <section id="unseen">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            while($row = $stmt->fetch())
                            {
                                ?>
                                <tr>
                                    <td><?php echo $row["ID"]; ?></td>
                                    <td><?php echo $row["Name"]; ?></td><td>
                                        <a href="categories_modify.php?ID= <?php echo $row["ID"]; ?>
                                        &Action=Update"><button class="btn btn-primary btn-xs">
                                                <i class="fa fa-pencil" title="edit"></i></button>
                                            <a href="categories_modify.php?ID= <?php echo
                                            $row["ID"]; ?> &Action=Delete"><button class="btn btn-danger btn-xs">
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
