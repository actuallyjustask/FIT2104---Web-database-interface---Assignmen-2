<html>
<head></head>
<body>
<center><H3>PHP Email</H3></center>
<?php
if (!isset($_POST["to"]))
{
    ?>
    <form method="post" action="email.php">
        <table border="0" width="100%">
            <tr>
                <td>To</td>
                <td><input type="text" name="to" size="45"></td>
            </tr>
            <tr>
                <td>Subject</td>
                <td><input type="text" name="subject" size="45"></td>
            </tr>
            <tr>
                <td>Message</td>
                <td valign="top" align="left">
                    <textarea cols="68" name="message" rows="9"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2"><br /><br /><input type="submit" value="Send Email">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
    <?php
}
else
{

    $from = "From: Harry Helper <janet.fraser@monash.edu.au>";
    $to = $_POST["to"];
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
?>
</body>
</html>