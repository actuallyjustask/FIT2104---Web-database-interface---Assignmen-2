<?php
ob_start();
include('session.php');
include('nav.php');

if (empty($_POST["Fname"]))
{


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clients</title>
</head>


<body>

  <section id="main-content">
      <section class="wrapper">
          <h3><i class="fa fa-angle-right"></i> Clients</h3>

          <!-- BASIC FORM ELELEMNTS -->
          <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Add Client</h4>
                      <form class="form-horizontal style-form" method="post" action="clients_add.php" >
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Fname">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Lname">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Address</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Street">
                                  <span class="help-block">Enter unit number and street name.</span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Suburb</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Suburb">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">State</label>
                              <div class="col-sm-10">
                                  <select class="form-control" name="State">
<!--                                      preselect vic-->
                                      <option>ACT</option>
                                      <option>NSW</option>
                                      <option>NT</option>
                                      <option>QLD</option>
                                      <option>SA</option>
                                      <option>TAS</option>
                                      <option selected>VIC</option>
                                      <option>WA</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Postcode</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Postcode">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Email</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Email">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Mobile</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="Mobile">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Mailing List</label>

                              <div class="col-sm-10">
                                  <select class="form-control" name="Mailinglist">
                                      <option>0</option>
                                      <!-- preselect yes-->
                                      <option selected>1</option>

                                  </select>
                                  <span class="help-block">1 for Yes; 0 for No.</span>
                              </div>
                          </div>
                          <p align="left">
                          <button type="submit" class="btn btn-theme">Add Client</button>
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

    $query = "INSERT INTO client (Fname, Lname, Street, Suburb, State, Postcode,
                Email, Mobile, Mailinglist) VALUES (NULLIF('$_POST[Fname]', ''), NULLIF('$_POST[Lname]', ''), '$_POST[Street]'
                , '$_POST[Suburb]', '$_POST[State]', '$_POST[Postcode]', NULLIF('$_POST[Email]', ''), '$_POST[Mobile]', '$_POST[Mailinglist]')";
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
        header("Location: clients_index.php");
    }
}

?>
</body>
</html>
