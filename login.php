<?php

  include 'classes/Login.php';

?>

<?php
  $login = new Login();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $loginChk = $login->checkLogin($name, $password);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>This is Page Title</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <p><br><br><br><br></p>
    
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <?php
              if (isset($loginChk)) {?>
              <div class="alert alert-success col-lg-6 col-lg-push-3 text-center">
                  <?php echo $loginChk;?>
              </div>
          <?php       
              }
          ?>
        </div>
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-body">
              <form action="" method="POST" accept-charset="utf-8">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password">
                </div>
                <input type="submit" value="Login" class="btn btn-primary">
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>