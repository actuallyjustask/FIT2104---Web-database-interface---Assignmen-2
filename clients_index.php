<?php
ob_start();
include('session.php');
include('nav.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clients</title>

</head>

<body>
<?php
include("connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh= new PDO($dsn, $Uname, $Pword);
$stmt = $dbh->prepare("select * from client order by Lname");
$stmt->execute();

?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Clients</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">
                    <a type="button" href="email.php"  class="btn btn-round btn-warning pull-right">Send Email</a>

                    <h4><i class="fa fa-angle-right"></i> Clients Table</h4>
                    <section id="unseen">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Surname</th>
                                <th>Street</th>
                                <th>Suburb</th>
                                <th>State</th>
                                <th>Postcode</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Mailing List</th>
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
                                    <td><?php echo $row["Fname"]; ?></td>
                                    <td><?php echo $row["Lname"]; ?></td>
                                    <td><?php echo $row["Street"]; ?></td>
                                    <td><?php echo $row["Suburb"]; ?></td>
                                    <td><?php echo $row["State"]; ?></td>
                                    <td><?php echo $row["Postcode"]; ?></td>
                                    <td><?php echo $row["Email"]; ?></td>
                                    <td><?php echo $row["Mobile"]; ?></td>
                                    <td><?php echo $row["Mailinglist"]; ?></td>
                                    <td>

                                        <a href="clients_modify.php?ID=<?php echo $row["ID"]; ?>&Action=Update"><button class="btn btn-primary btn-xs">
                                                <i class="fa fa-pencil" title="Edit"></i></button>
                                        <a href="clients_modify.php?ID=<?php echo
                                        $row["ID"]; ?>&Action=Delete"><button class="btn btn-danger btn-xs">
                                                <i class="fa fa-trash-o " title="Delete"></i></button>

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

<?php
$stmt->closeCursor();



include('footer.php')


?>
</body>
</html>
