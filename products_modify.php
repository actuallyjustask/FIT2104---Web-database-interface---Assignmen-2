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
<script language = "javascript">
    function confirm_delete()
    {
        window.location='products_modify.php?ID=<?php echo $_GET["ID"];?> &Action=ConfirmDelete'; }
</script>

<?php
//include and connection statements go here
$query="SELECT * FROM product WHERE ID =".$_GET["ID"];
$catequery="SELECT * FROM category ORDER BY Name";
$pcquery= "SELECT category.ID from product join product_category on product.ID = product_category.product_id join category on category.ID=product_category.Category_id
Where product.ID = $_GET[ID] ORDER BY product.Name";



include("connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh= new PDO($dsn, $Uname, $Pword);
$stmt = $dbh->prepare($query);
$stmt->execute();
$row=$stmt->fetchObject();

$catestmt = $dbh->prepare($catequery);
$catestmt->execute();

$imgquery= "SELECT * from product join product_image on product.ID = product_image.product_id Where product.ID = $_GET[ID]";
$imgstmt = $dbh->prepare($imgquery);
$imgstmt->execute();
$imgrow = $imgstmt->fetch();



switch($_GET["Action"]) {
    case "Delete":
        ?>
        <div align="center">

            </br></br></br></br></br>
            <h3>
                Confirm deletion of the Product record <br /></h3>

            <table>
                <tr>
                    <td><h3>Product ID: </h3></td>
                    <td><h3><?php echo $row->ID; ?></h3></td>
                </tr>
                <tr>
                    <td><h3>Name:</h3></td>
                    <td><h3><?php echo $row->Name?></h3></td>
                </tr>
                <tr>
                    <td>
                        <?php if (!empty($imgrow["Name"])){ ?>
                    <div class="col-sm-10">
                        <a target="_blank" href="product_images/<?php echo $imgrow["Name"]?>">
                            <img src="product_images/<?php echo $imgrow["Name"]?>" alt="Forest" style="width:150px">
                        </a>
                    </div>
                        <?php }
                        else {

                        }?>

                    <td>
                </tr>
            </table>
            <br/>

        </div>



        <table align="center">

            <tr>

                <td>
                    <input type="button" value="Cancel" class="btn btn-default" OnClick="window.location='Products_index.php'">
                </td>
                <td>
                    <input type="button" value="Delete" class="btn btn-danger" OnClick="confirm_delete();">
                </td>
            </tr>
        </table>
        <?php    break;
    case "ConfirmDelete":
        $query="DELETE FROM product WHERE ID =".$_GET["ID"];
        $stmt = $dbh->prepare($query);
        $pc_del_query = "DELETE FROM product_category WHERE product_id = $_GET[ID];";
        $pc_del_stmt = $dbh->prepare($pc_del_query);
        $pc_del_stmt->execute();

        $img_id = $imgrow['ID'];

        $img_del_query = "DELETE FROM product_image WHERE ID = $img_id";

        $imgstmt = $dbh->prepare($imgquery);
        $imgstmt->execute();


        if($stmt->execute())
        {
            ?>
            <div align="center">
            </br></br></br></br></br>
            <h3 style="color: green">
                The following product record has been successfully deleted!<br /></h3>
            <table>
                <tr>
                    <td><h3>Product ID: </h3></td>
                    <td><h3><?php echo $row->ID; ?></h3></td>
                </tr>
                <tr>
                    <td><h3>Name:</h3></td>
                    <td><h3><?php echo $row->Name; ?></h3></td>
                </tr>
            </table>

            <?php
        }
        else
        {
            echo "Error deleting product record";
        }?>
        </br>
        <?php
        echo "<input type='button' value='Return to List' class=\"btn btn-primary\" OnClick='window.location=\"products_index.php\"'><p />";
        break;?>
        </div>
    <?php case "Update": ?>
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Products</h3>

            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Product Details Amendment</h4>
                        <form class="form-horizontal style-form" method="post" action="products_modify.php?ID=<?php echo $_GET["ID"]; ?>&Action=ConfirmUpdate" >

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Name" value="<?php echo $row->Name; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Purchase Price</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="PurchasePrice" value="<?php echo $row->Purchase_Price; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sale Price</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="SalePrice" value="<?php echo $row->Sale_Price; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Country of Origin</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="CountryofOrigin" value="<?php echo $row->Country_of_Origin; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Product Categories</label>
                                <div class="col-sm-10" style="font-size: 15px">
                                    <table class="table custom-check">
                                        <tbody>
                                        <?php
                                        while($caterow = $catestmt->fetch())
                                        {
                                            $pcstmt = $dbh->prepare($pcquery);
                                            $pcstmt->execute();
                                            ?>
                                        <tr>
                                            <td>
                                                <span class="check"><input type="checkbox" name="check[]" value = "<?php echo $caterow['ID']; ?>" class="checked" <?php
                                                    //checked string
                                                    while($pcrow = $pcstmt->fetch())
                                                    {
                                                        echo fCheck($caterow['ID'],$pcrow['ID']);

                                                    }
                                                    ?>></span>
                                                <?php echo $caterow["Name"];?>
                                            </td>
                                        </tr>
                                        <?php }
                                        $pcstmt->closeCursor();
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Images</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">Please Go to 'Images' sction to edit image.</p>
                                </div>
                            </div>

                            <p align="left">
                                <button type="submit" class="btn btn-theme">Update Product</button>
                                <input type="button" value="Return to List" class="btn btn-theme" style="background-color: darkorange" OnClick="window.location='products_index.php'">
                            </p>

                        </form>

                    </div>
                </div><!-- col-lg-12-->
            </div><!-- /row -->
        </section>
    </section>
    <?php
    break;
    case "ConfirmUpdate":
        $query="UPDATE product set Name='$_POST[Name]', Purchase_Price='$_POST[PurchasePrice]', Sale_Price='$_POST[SalePrice]', Country_of_Origin='$_POST[CountryofOrigin]' WHERE ID =".$_GET["ID"];
        $stmt = $dbh->prepare($query);

        $pc_del_query = "DELETE FROM product_category WHERE product_id = $_GET[ID];";
        $pc_del_stmt = $dbh->prepare($pc_del_query);
        $pc_del_stmt->execute();
        foreach ($_POST["check"] as $item) {
           $pc_add_query = "INSERT INTO product_category (product_id, category_id) VALUES (NULLIF('$_GET[ID]', ''),NULLIF($item, ''))";
           $pc_add_stmt = $dbh->prepare($pc_add_query);
            $pc_add_stmt->execute();
        }

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
            $stmt->closeCursor();
            $catestmt->closeCursor();
            $imgstmt->closeCursor();
            $pc_del_stmt->closeCursor();
            $pc_add_stmt->closeCursor();


            header("Location: products_index.php");
        }
}

?>
<?php include('footer.php')?>