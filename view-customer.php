<?php 
    include 'inc/header.php';
    include 'classes/Login.php';

    $login = new Login();
 ?> 

 <?php
  if (isset($_GET['delcustomer'])) {
    $id = $_GET['delcustomer'];
    $delcustomer = $login->delCustomerById($id);
  }
?>
 
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron">


      <?php
        $getCustomer = $login->getAllCustomer();
        if (!$getCustomer){
          ?>
          <div class="panel panel-body text-center">
            <h2>No Customer Available</h2>
          </div>
          <?php
        } else {
          ?>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
          <?php
          $i = 0;
          while ($result = $getCustomer->fetch_assoc()) {
            $i++;
          
      ?>

      <tbody>

        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $result['name']; ?></td>
          <td><?php echo $result['email']; ?></td>
          <td><?php echo $result['user_type']; ?></td>
          <td>
            <a href="edit-customer.php?customerId=<?php echo $result['id']; ?>">
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a> 
            &nbsp;
            <a onclick="return confirm('Are you sure to delete?')" href="?delcustomer=<?php echo $result['id']; ?>">
              <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </a>
          </td>
          <?php
            }
        }
          ?>
        </tr>
        
      </tbody>
    </table>
    </div>
  </div>
</div>      

<?php include 'inc/footer.php'; ?>
