<?php
session_start();
if(session_destroy()) {
    $message = "You have logged out! Click OK to redirect.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Refresh:0.5; url=index.php");


}
?>