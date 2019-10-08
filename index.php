<?php
session_start();
ob_start();

include('nav.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Home</title>
</head>

<body style="">

<section id="container">
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
<!--            --><?php
//            if (!isset($_SESSION['username'])){
//                echo 'You are not logged in!';
//
//            }
//            else{
//                echo 'You are logged in!';
//                echo $_SESSION['username'];
//            }
//            ?>
            <div class="row">

                <div class="col-lg-9 main-chart">
                    <div class="row mt">

                        <!-- SERVER STATUS PANELS -->
                        <div class="col-md-4 col-sm-4 mb">
                            <div class="white-panel pn">

                                <div class="white-header">
                                    <h5>TOP PRODUCT</h5>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-6 goleft">
                                        <p><i class="fa fa-heart"></i> 122</p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6"></div>
                                </div>
                                <div class="centered">
                                    <img src="assets/img/product.png" width="120">
                                </div>
                            </div>
                        </div><!-- /col-md-4 -->

                        <div class="col-md-4 col-sm-4 mb">
                            <div class="white-panel pn">
                                <div class="white-header">
                                    <h5>TOP PRODUCT</h5>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-6 goleft">
                                        <p><i class="fa fa-heart"></i> 122</p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6"></div>
                                </div>
                                <div class="centered">
                                    <img src="assets/img/product.png" width="120">
                                </div>
                            </div>
                        </div><!-- /col-md-4 -->

                        <div class="col-md-4 col-sm-4 mb">
                            <div class="white-panel pn">
                                <div class="white-header">
                                    <h5>TOP PRODUCT</h5>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-6 goleft">
                                        <p><i class="fa fa-heart"></i> 122</p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6"></div>
                                </div>
                                <div class="centered">
                                    <img src="assets/img/product.png" width="120">
                                </div>
                            </div>
                        </div><!-- /col-md-4 -->
                    </div>
                </div><!-- /col-lg-9 END SECTION MIDDLE -->
            </div><!-- --/row ---->
        </section>
    </section>


</section>



<?php include('footer.php') ?>

</body>
</html>
