<?php
ob_start();
include('session.php');
include('nav.php');
function fCheck($value1, $value2)
{
    $strCheck = "";
    if($value1 == $value2)
    {
        $strCheck = " checked";
    }
    return $strCheck;
}



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
$query="SELECT * FROM product WHERE ID =".$_GET["ID"]." ORDER BY NAME" ;
//echo $query;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row=$stmt->fetchObject();

$catequery="SELECT * FROM category ORDER BY Name";

$catestmt = $dbh->prepare($catequery);
$catestmt->execute();

$pcquery= "SELECT category.Name from product join product_category on product.ID = product_category.product_id join category on category.ID=product_category.Category_id
Where product.ID = $_GET[ID] ORDER BY category.Name";
$pcstmt = $dbh->prepare($pcquery);
$pcstmt->execute();




?>
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Products</h3>

        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Product Details Amendment</h4>
                    <form class="form-horizontal style-form" action="products_view.php" method="GET">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo $row->Name; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Purchase Price</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo $row->Purchase_Price; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Sale Price</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo $row->Sale_Price; ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Country of Origin</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo $row->Country_of_Origin; ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Product Categories</label>
                            <div class="col-sm-10" style="font-size: 15px">
                                <table class="table custom-check">
                                    <tbody>
                                                <?php
                                                while($pcrow=$pcstmt->fetch())
                                                {?>
                                                <tr><td><?php
                                                echo $pcrow["Name"];?></td></tr>
                                                <?php
                                                }
                                                $pcstmt->closeCursor();
                                                ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div>
                            <table>
                            <tr>
                            <td><button type="button" class="btn btn-theme"><a style="color: white" href="products_modify.php?ID=<?php echo $_GET["ID"]; ?>&Action=Update">Update</button></td>
                                <td><button type="button" class="btn btn-danger"><a style="color: white" href="products_modify.php?ID=<?php echo $_GET["ID"]; ?>&Action=Delete">Delete</button></td>
                            </tr>
                            </table>
                        </div>

                    </form>
                </div>
                <p align="left">   <br />
                    <input type="button" value="Go Back" class="btn btn-primary" OnClick="window.location='products_index.php'">
                </p>
            </div><!-- col-lg-12-->
        </div><!-- /row -->
    </section>
</section>

<?php include('footer.php')?>