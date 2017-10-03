<?php include 'inc/header.php'; ?>
<?php
    include 'classes/Login.php';
    $login = new Login();
?>
<?php

    if (!isset($_GET['customerId']) || $_GET['customerId'] == NULL) {
        echo "<script>window.location = 'view-customer.php'; </script>";
    } else {
        $id = $_GET['customerId'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $type = $_POST['user_type'];

        $updateCustomer = $login->updateCustomer($name, $email, $type, $id);
    }
?>
<div class="container">
<?php
    if (isset($updateCustomer)) {?>
    <div class="alert alert-success col-lg-6 col-lg-push-3 text-center">
        <?php echo $updateCustomer;?>
    </div>
<?php       
    }
?>
</div> 

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron">

        <h2>Edit Customer</h2>
        <?php
            $getCustomer = $login->getCustomerById($id);
            if ($getCustomer) {
                while ($value = $getCustomer->fetch_assoc()) {                      
        ?>
        <form action="" method="POST" accept-charset="utf-8">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="name" value="<?php echo $value['name']; ?>">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" name="email" value="<?php echo $value['email']; ?>">
                </div>
                <div class="form-group">
                  <label>Type</label>
                  <select name="user_type" class="form-control">
                  	<option value="">Select Type</option>
                  	
                    <?php
                      if ($value['user_type'] == 'Admin') {
                        ?>
                        <option value="Admin" selected="selected">Admin</option>
                        <option value="Customer">Customer</option>
                        <?php
                      }else{?>
                        <option value="Admin">Admin</option>
                        <option value="Customer" selected="selected">Customer</option>
                      <?php
                    }
                    ?>
                    ?>
                  </select>
                </div>
                <input type="submit" value="Update" class="btn btn-primary">
        </form>
        <?php
          }
        }
        ?>
    </div>
  </div>
</div>     

<?php include 'inc/footer.php'; ?>