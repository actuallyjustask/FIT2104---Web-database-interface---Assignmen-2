<?php
session_start();
ob_start();

include('nav.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Documentation</title>
</head>

<body>
<section id="container" >
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->


    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> Documentation</h3>
            <div class="showback">
                <h3><i class="fa fa-angle-right"></i> Authors</h3>
                <br/>
                <h4>Chaojie Chen [28405692]</h4>
                <h4>Arsalan Shahid [29808677]</h4>
                <h4><b>Submission Date: 11/10/2019</b></h4>
            </div>
            <div class="showback">
                <h3><i class="fa fa-angle-right"></i> Website Account</h3>
                <br/>
                <h4>Username: test</h4>
                <h4>Password: 123</h4>
                <h5>(Or you are able to register.)</h5>

            </div>
            <div class="showback">
                <h3><i class="fa fa-angle-right"></i> Database Account</h3>
                <br/>
                <h4>Host: 130.194.7.82</h4>
                <h4>User: s28405692</h4>
                <h4>Password: monash00</h4>
                <h4>Database: s28405692</h4>

            </div>

            <div class="showback">
                <h3><i class="fa fa-angle-right"></i> Database Schema (Create Table Statement)</h3>
                <br/>
                <h4><a href="store.db.sql">store.db.sql</a></h4>

            </div>

            <div class="showback">
                <h3><i class="fa fa-angle-right"></i> Database snapshot </h3>
                <br/>
                <h4><a href="Database_Snapshot.zip">Database_Snapshot.zip</a></h4>


            </div>

            <div class="showback">
                <h3><i class="fa fa-angle-right"></i> Work breakdown</h3>
                <br/>
                <h4><a href="Work_Breakdown.txt">Work_Breakdown.txt</a></h4>


            </div>

        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->

</section>


</body>
</html>
<?php include('footer.php') ?>