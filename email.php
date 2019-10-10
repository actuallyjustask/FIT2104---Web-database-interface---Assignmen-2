<?php
ob_start();
include('session.php');
include('nav.php');
?>

<html>
<head></head>
<body>

<?php
include("connection.php");
$dsn= "mysql:host=$Host;dbname=$DB";
$dbh= new PDO($dsn, $Uname, $Pword);

$clientsquery="SELECT * FROM client WHERE Mailinglist='1';";

$clientsstmt = $dbh->prepare($clientsquery);
$clientsstmt->execute();

if (!isset($_POST["check"]))
{
    ?>
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Clients</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4><i class="fa fa-angle-right"></i> Send Email</h4>
                    <form class="form-horizontal style-form" method="post" action="email.php">
<!--                        <div class="form-group">-->
<!--                            <label class="col-sm-1 control-label">To</label>-->
<!--                            <div class="col-sm-4">-->
<!--                                <input type="text" class="form-control" name="to" value="">-->
<!--                            </div>-->
<!--                        </div>-->

                        <div class="form-group">
                            <label class="col-sm-2 control-label">To</label>
                            <div class="col-sm-10" style="font-size: 15px">
                                <table class="table custom-check">
                                    <tbody>

                                    <?php
                                    while($clientsrow=$clientsstmt->fetch())
                                    { ?>
<!--                                        Print out all select name and email-->
                                    <tr>
                                        <td>
                                            <span class="check"><input type="checkbox" name="check[]" class="checked" value = "<?php echo $clientsrow['ID']; ?>" class="checked"></span>
                                            <?php echo $clientsrow["Fname"]." ".$clientsrow["Lname"].": ".$clientsrow["Email"];?>
                                        </td>
                                    </tr>
                                    <?php
                                    }

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-1 control-label">Subject</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="subject" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">Message</label>
                            <div class="col-sm-4">
                                <textarea rows="9" type="text" class="form-control" name="message">
                                </textarea>
                            </div>
                        </div>
                        <p align="left">
                        <input type="submit" class="btn btn-theme" value="Send Email">
                        <input type="reset" value="Reset" class="btn btn-theme" style="background-color: darkorange">
                        </p>
                    </form>

                </div><!-- /content-panel -->
            </div><!-- /col-lg-4 -->
        </div><!-- /row -->
        </div><!-- /row -->
    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->

    <?php
}
else
{
    $email_string = "";
    foreach ($_POST["check"] as $item) {
    $get_email_query="SELECT * FROM client WHERE ID=$item;";
        $get_email_stmt = $dbh->prepare($get_email_query);
        $get_email_stmt->execute();
        $get_email_row=$get_email_stmt->fetch();
//        append all emails into a string with "," splitter.
        $email_string=$email_string.$get_email_row['Email'].",";
    }
    $from = "From: Harry Helper <Harry@monash.edu.au>";
    $to = $email_string;
    $msg = $_POST["message"];
    $subject = $_POST["subject"];
    if(mail($to, $subject, $msg, $from))
    {
        echo "Mail Sent";
    }
    else
    {
        echo "Error Sending Mail";
    }
}

include('footer.php');
?>
</body>
</html>