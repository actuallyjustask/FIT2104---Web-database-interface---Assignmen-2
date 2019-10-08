<?php
ob_start();
include('session.php');
include('nav.php');

?>
<script language = "javascript">
    function confirm_delete()
    {
        window.location='categories_modify.php?ID=<?php echo $_GET["ID"];?> &Action=ConfirmDelete'; }
</script>

<?php
//include and connection statements go here
$query="SELECT * FROM category WHERE ID =".$_GET["ID"];

include("connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh= new PDO($dsn, $Uname, $Pword);
$stmt = $dbh->prepare($query);
$stmt->execute();
$row=$stmt->fetchObject();

switch($_GET["Action"]) {
    case "Delete":
        ?>
        <div align="center">
            </br></br></br></br></br>
            <h3>
                Confirm deletion of the Category record <br /></h3>
            <table>
                <tr>
                    <td><h3>Category ID: </h3></td>
                    <td><h3><?php echo $row->ID; ?></h3></td>
                </tr>
                <tr>
                    <td><h3>Name:</h3></td>
                    <td><h3><?php echo $row->Name?></h3></td>
                </tr>
            </table>
            <br/>
        </div>
        <table align="center">
            <tr>

                <td>
                    <input type="button" value="Cancel" class="btn btn-default" OnClick="window.location='Categories_index.php'">
                </td>
                <td>
                    <input type="button" value="Delete" class="btn btn-danger" OnClick="confirm_delete();">
                </td>
            </tr>
        </table>
        <?php    break;
    case "ConfirmDelete":
        $query="DELETE FROM category WHERE ID =".$_GET["ID"];

        $stmt = $dbh->prepare($query);
        if($stmt->execute())
        {
            ?>
            <div align="center">
            </br></br></br></br></br>

            <h3 style="color: green">
                The following category record has been successfully deleted!<br /></h3>
            <table>
                <tr>
                    <td><h3>Category ID: </h3></td>
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
            echo "Error deleting category record";
        }?>
        </br>
        <?php
        echo "<input type='button' value='Return to List' class=\"btn btn-primary\" OnClick='window.location=\"categories_index.php\"'><p />";
        break;?>
        </div>
    <?php case "Update": ?>
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Categroies</h3>

            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Category Details Amendment</h4>
                        <form class="form-horizontal style-form" method="post" action="categories_modify.php?ID=<?php echo $_GET["ID"]; ?>&Action=ConfirmUpdate" >

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Name" value="<?php echo $row->Name; ?>">
                                </div>
                            </div>


                            <p align="left">
                                <button type="submit" class="btn btn-theme">Update Category</button>
                                <input type="button" value="Return to List" class="btn btn-theme" style="background-color: darkorange" OnClick="window.location='categories_index.php'">
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
        $query="UPDATE category set Name='$_POST[Name]' WHERE ID =".$_GET["ID"];
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
            $stmt->closeCursor();
            header("Location: categories_index.php");
        }
}

?>
