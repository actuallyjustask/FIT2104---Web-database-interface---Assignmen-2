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
$stmt->execute();


if(!empty($_GET['search'])){
    $query= "SELECT * from product join product_category on product.ID = product_category.Product_id join category on category.ID=product_category.Category_id
Where category.Name LIKE '%$_GET[search]%' order by product.Name;";

}else{
    $query = "select * from product ORDER BY Name";
}
//echo $query;
$stmt = $dbh->prepare($query);
$stmt->execute();




?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Products</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">

                    <h4><i class="fa fa-angle-right"></i> Products Table</h4>
                    <div class="col-lg-6">
                        <form class="form-group" action="products_index.php" method="GET">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Search by Category">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-white btn-round btn-just-icon btn-primary">
                                    <i class="material-icons">search</i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <br /><br /><br />
                    <section id="unseen">
                        <table class="table table-bordered table-striped table-condensed">

                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Purchase Price ($)</th>
                                <th>Sale Price ($)</th>
                                <th>Country of Origin</th>
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
                                    <!--                                    $row[1] = $row['product.Name']; since product.Name and
                                                                            category.Name have same attribute Name, php cant figure out
                                                                            which Name was selected, it displays the category.Name if I
                                                                            just use $row['Name']. Thus use $row[1] to display
                                                                            product.Name-->
                                    <td><?php echo $row[1]; ?></td>
                                    <td><?php echo $row["Purchase_Price"]; ?></td>
                                    <td><?php echo $row["Sale_Price"]; ?></td>
                                    <td><?php echo $row["Country_of_Origin"]; ?></td>
                                    <td>
                                        <a href="products_view.php?ID=<?php echo $row["ID"]; ?>">
                                            <button class="btn btn-success btn-xs"><i class=" fa fa-eye" title="View"></i></button>
                                            <a href="products_modify.php?ID=<?php echo $row["ID"]; ?>&Action=Update"><button class="btn btn-primary btn-xs">
                                                    <i class="fa fa-pencil" title="Edit"></i></button>
                                                <a href="products_modify.php?ID=<?php echo
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
<?php include('footer.php');



$stmt->closeCursor();
?>
</body>
</html>
