<?php
ob_start();
include('session.php');
include('nav.php');

$catequery="SELECT * FROM category ORDER BY Name";
$catestmt = $dbh->prepare($catequery);
$catestmt->execute();

if (empty($_POST["Name"]))
{


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Products</title>
</head>


<body>

<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Products</h3>

        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Add Product</h4>
                    <form class="form-horizontal style-form" method="post" action="products_add.php" >
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Product Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Purchase Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="Purchase_Price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Sale Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="Sale_Price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Country of Origin</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="Country_of_Origin">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Product Categories</label>
                            <div class="col-sm-10" style="font-size: 15px">
                                <table class="table custom-check">
                                    <tbody>
                                    <?php
                                    while($caterow = $catestmt->fetch())
                                    {

                                        ?>
                                        <tr>
                                            <td>
                                                <span class="check"><input type="checkbox" name="check[]" value = "<?php echo $caterow['ID']; ?>" class="checked">
                                                </span>
                                                <?php echo $caterow["Name"];?>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <p align="left">
                            <button type="submit" class="btn btn-theme">Add Product</button>
                            <input type="Reset" Value="Clear Form Fields" class="btn btn-theme" style="background-color: darkorange">
                        </p>

                    </form>
                </div>
            </div><!-- col-lg-12-->
        </div><!-- /row -->
    </section>
</section>

<?php include('footer.php');
}
else {
    include("connection.php");
    $dsn= "mysql:host=$Host;dbname=$DB";
    $dbh= new PDO($dsn, $Uname, $Pword);

    $query = "INSERT INTO product (Name, Purchase_Price, Sale_Price, Country_of_Origin) VALUES (NULLIF('$_POST[Name]', ''), NULLIF('$_POST[Purchase_Price]','')
                , NULLIF('$_POST[Sale_Price]',''), '$_POST[Country_of_Origin]')";
    $stmt = $dbh->prepare($query);
    if(!$stmt->execute())
    {
        $err= $stmt->errorInfo(); ?>
        <section id="main-content">
            <section class="wrapper">
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
            </section></section>

        <?php
    }
    else {
        $pid = $dbh->lastInsertId();
        foreach ($_POST["check"] as $item) {
            $pc_add_query = "INSERT INTO product_category (product_id, category_id) VALUES (NULLIF($pid, ''),NULLIF($item, ''))";
            $pc_add_stmt = $dbh->prepare($pc_add_query);
            $pc_add_stmt->execute();
        }

        $stmt->closeCursor();
        $catestmt->closeCursor();
        $pc_add_stmt->closeCursor();
       header("Location: products_index.php");
    }
}

?>
</body>
</html>
