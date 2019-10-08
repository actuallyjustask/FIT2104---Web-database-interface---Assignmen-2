
<?php
ob_start();
include('session.php');
include('nav.php');

function fSelect($value1, $value2)
{
    $strSelect = "";
    if($value1 == $value2)
    {
        $strSelect = " selected";
    }
    return $strSelect;
}
?>
<script language = "javascript">
    function confirm_delete()
    {
        window.location='Clients_modify.php?ID=<?php echo $_GET["ID"];?> &Action=ConfirmDelete'; }
</script>

<?php
//include and connection statements go here
$query="SELECT * FROM client WHERE ID =".$_GET["ID"];

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
            Confirm deletion of the Client record <br /></h3>
            <table>
                <tr>
                    <td><h3>Client ID: </h3></td>
                    <td><h3><?php echo $row->ID; ?></h3></td>
                </tr>
                <tr>
                    <td><h3>Name:</h3></td>
                    <td><h3><?php echo $row->Fname,' ',$row->Lname; ?></h3></td>
                </tr>
            </table>
            <br/>
        </div>
        <table align="center">
            <tr>

                <td>
                    <input type="button" value="Cancel" class="btn btn-default" OnClick="window.location='clients_index.php'">
                </td>
                <td>
                    <input type="button" value="Delete" class="btn btn-danger" OnClick="confirm_delete();">
                </td>
            </tr>
        </table>
        <?php    break;
    case "ConfirmDelete":
        $query="DELETE FROM client WHERE ID =".$_GET["ID"];

        $stmt = $dbh->prepare($query);
        if($stmt->execute())
        {
            ?>
            <div align="center">
            </br></br></br></br></br>

            <h3 style="color: green">
            The following client record has been successfully deleted!<br /></h3>
            <table>
                <tr>
                    <td><h3>Client ID: </h3></td>
                    <td><h3><?php echo $row->ID; ?></h3></td>
                </tr>
                <tr>
                    <td><h3>Name:</h3></td>
                    <td><h3><?php echo $row->Fname,' ',$row->Lname; ?></h3></td>
                </tr>
            </table>
                <?php
        }
        else
        {
            echo "Error deleting client record";
        }?>
    </br>
    <?php
        echo "<input type='button' value='Return to List' class=\"btn btn-primary\" OnClick='window.location=\"clients_index.php\"'><p />";
        break;?>
        </div>
    <?php case "Update": ?>
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Clients</h3>

            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Client Details Amendment</h4>
                        <form class="form-horizontal style-form" method="post" action="Clients_modify.php?ID=<?php echo $_GET["ID"]; ?>&Action=ConfirmUpdate" >

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Fname" value="<?php echo $row->Fname; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Lname" value="<?php echo $row->Lname; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Street" value="<?php echo $row->Street; ?>">
                                    <span class="help-block">Enter unit number and street name.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Suburb</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Suburb" value="<?php echo $row->Suburb; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">State</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="State" value="<?php echo $row->State; ?>">
<!--                                        pre select state-->
                                        <option <?php echo fSelect('ACT',$row->State); ?>>ACT</option>
                                        <option <?php echo fSelect('NSW',$row->State); ?>>NSW</option>
                                        <option <?php echo fSelect('NT',$row->State); ?>>NT</option>
                                        <option <?php echo fSelect('QLD',$row->State); ?>>QLD</option>
                                        <option <?php echo fSelect('SA',$row->State); ?>>SA</option>
                                        <option <?php echo fSelect('TAS',$row->State); ?>>TAS</option>
                                        <option <?php echo fSelect('VIC',$row->State); ?>>VIC</option>
                                        <option <?php echo fSelect('WA',$row->State); ?>>WA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Postcode</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Postcode" value="<?php echo $row->Postcode; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Email" value="<?php echo $row->Email; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Mobile</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Mobile" value="<?php echo $row->Mobile; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Mailing List</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Mailinglist" value="<?php echo $row->Mailinglist; ?>">
<!--                                        set preselect, if 0 in db, preselect 0, if 1, preselect 1-->
                                        <option <?php echo fSelect('0',$row->Mailinglist); ?>>0</option>
                                        <option <?php echo fSelect('1',$row->Mailinglist); ?>>1</option>
                                    </select>
                                    <span class="help-block">1 for Yes; 0 for No.</span>
                                </div>
                            </div>
                            <p align="left">
                                <button type="submit" class="btn btn-theme">Update Client</button>
                                <input type="button" value="Return to List" class="btn btn-theme" style="background-color: darkorange" OnClick="window.location='clients_index.php'">
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
        $query="UPDATE client set Fname='$_POST[Fname]', Lname='$_POST[Lname]', Street='$_POST[Street]', 
Suburb='$_POST[Suburb]', State='$_POST[State]', Mobile='$_POST[Mobile]', Mailinglist='$_POST[Mailinglist]' WHERE ID =".$_GET["ID"];
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        header("Location: clients_index.php");
        break;
        $stmt->closeCursor();
} ?>