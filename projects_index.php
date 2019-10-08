<?php
ob_start();
include('session.php');
include('nav.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="assets/css/table-responsive.css" rel="stylesheet">
    <title>Projects</title>
</head>

<body>
<?php
include("connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh= new PDO($dsn, $Uname, $Pword);
$stmt = $dbh->prepare("select * from project");
$stmt->execute();
?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Projects</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i> Projects Table</h4>
                    <section id="unseen">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Description</th>
                                <th>Country</th>
                                <th>City</th>
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
                                    <td><?php echo $row["Description"]; ?></td>
                                    <td><?php echo $row["Country"]; ?></td>
                                    <td><?php echo $row["City"]; ?></td>
                                    <td>
                                        <a href="projects_modify.php?ID= <?php echo $row["ID"]; ?>
                                        &Action=Update"><button class="btn btn-primary btn-xs">
                                                <i class="fa fa-pencil" title="edit"></i></button>
                                            <a href="projects_modify.php?ID= <?php echo
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
