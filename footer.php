<?php
//https://www.cnblogs.com/apolloren/p/9281035.html
function php_self(){
    $php_self=substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
    return $php_self;
}
$phpself = php_self();
?>
<section id="main-content">
    <section class="wrapper">
            <div class="col-lg-12">
                <a type="button" target="_blank" href="Source_Code.php?filename=<?php echo $phpself ?>"  class="btn btn-round btn-warning" style="size: 20px">Source Code</a>
        </div>
    </section>
</section>
<footer class="site-footer">
    <div class="text-center">
        Copyright © Copyright © 2019 Famox. All Rights Reserved.
        <a href="#" class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
</footer>
<!--footer end-->
