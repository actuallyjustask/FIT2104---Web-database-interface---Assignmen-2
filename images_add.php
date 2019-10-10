<?php
ob_start();
include('session.php');
include('nav.php');

if (empty($_POST["Name"]))
{


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Categories</title>
</head>


<body>

<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Categories</h3>

        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Add Category</h4>
                    <form class="form-horizontal style-form" method="post" action="categories_add.php" >
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Category Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="Name">
                            </div>
                        </div>

                        <p align="left">
                            <button type="submit" class="btn btn-theme">Add Category</button>
                            <input type="Reset" Value="Clear Form Fields" class="btn btn-theme" style="background-color: darkorange">
                        </p>

                    </form>
                </div>
            </div><!-- col-lg-12-->
        </div><!-- /row -->
    </section>
</section>

<?php include('footer.php');
}
else {
    include("connection.php");
    $dsn= "mysql:host=$Host;dbname=$DB";
    $dbh= new PDO($dsn, $Uname, $Pword);

    $query = "INSERT INTO category (Name) VALUES (NULLIF('$_POST[Name]', ''))";
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
</body>
</html>
