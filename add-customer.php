<?php include 'inc/header.php'; ?>
<?php
    include 'classes/Login.php';
?>
<?php
    $login = new Login();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $type = $_POST['user_type'];

        $addCustomer = $login->addCustomer($name, $email, $password, $type);
    }
?>
<div class="container">
<?php
    if (isset($addCustomer)) {?>
    <div class="alert alert-success col-lg-6 col-lg-push-3 text-center">
        <?php echo $addCustomer;?>
    </div>
<?php       
    }
?>
</div> 

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron">
        <h2>Add Customer</h2>
        <form action="" method="POST" accept-charset="utf-8">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" name="email" placeholder="Enter Email">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Enter Password">
                </div>
                <div class="form-group">
                  <label>Type</label>
                  <select name="user_type" class="form-control">
                  	<option value="">Select Type</option>}
                  	<option value="Admin">Admin</option>
                  	<option value="Customer">Customer</option>
                  </select>
                </div>
                <input type="submit" value="Add" class="btn btn-primary">
        </form>
    </div>
  </div>
</div>     

<?php include 'inc/footer.php'; ?>