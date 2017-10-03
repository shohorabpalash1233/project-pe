<?php
    include 'lib/Session.php';
    Session::checkSession();
?>
<?php
  if (isset($_GET['action']) && $_GET['action'] == "logout") {
        Session::destroy();
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
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/bootstrap-tokenfield.css">
  </head>
  <body>
    
<!-- navbar starts -->

    <nav class="navbar navbar-inverse navbar-static-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php
          if(Session::get('type') == 'Admin'){
        ?>
        <li><a href="add-product.php">Add Product</a></li>
        <li><a href="add-category.php">Add Category</a></li>
        <li><a href="add-customer.php">Add Customer</a></li>
        <li><a href="view-product.php">View Product</a></li>
        <li><a href="view-category.php">View Category</a></li>
        <li><a href="view-customer.php">View Customer</a></li>
        <li><a href="view-product-list.php">View Product List</a></li>
        <?php
          }else{
        ?>
          <li><a href="view-product-list.php">View Product List</a></li>
        <?php
          }
        ?>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello! <?php echo Session::get('user'); ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="?action=logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- navbar ends -->