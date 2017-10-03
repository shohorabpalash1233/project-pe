<?php 
    include 'inc/header.php';
    include 'classes/Category.php';
    include 'classes/Product.php';
    include_once 'helper/Format.php';
    
    $fm = new Format();
    $cat = new Category();
    $product = new Product();
 ?> 

 <?php
  if (isset($_GET['delproduct'])) {
    $id = $_GET['delproduct'];
    $delproduct = $product->delProductById($id);
  }
?>

<div class="container">
<?php
    if (isset($delproduct)) {?>
    <div class="alert alert-success col-lg-6 col-lg-push-3 text-center">
        <?php echo $delproduct;?>
    </div>
<?php       
    }
?>
</div>  
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="jumbotron">
    

      <?php
        $getProduct = $product->getAllProduct();
        if (!$getProduct){
          ?>
          <div class="panel panel-body text-center">
            <h2>No Products Available</h2>
          </div>
          <?php
        } else {
          ?>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Serial</th>
                <th>Product Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Size</th>
                <th>Color</th>
                <th>Date Added</th>
                <th>Stock Quantity</th>
                <th>Purchase Price</th>
                <th>Selling Price</th>
                <th>Action</th>
              </tr>
            </thead>
          <?php
          $i = 0;
          while ($result = $getProduct->fetch_assoc()) {
            $i++;
          
      ?>
      
      <tbody>

        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $result['title']; ?></td>
          <td><?php echo $fm->textShorten($result['description'], 50); ?></td>
          <td><?php echo $result['catName']; ?></td>
          <td><?php echo $result['size']; ?></td>
          <td><?php echo $result['color']; ?></td>
          <td><?php echo $result['entrydate']; ?></td>
          <td><?php echo $result['stock']; ?> Pcs</td>
          <td>$<?php echo $result['purchase']; ?></td>
          <td>$<?php echo $result['sell']; ?></td>
          <td>
            <a href="edit-product.php?pId=<?php echo $result['id']; ?>">
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a> 
            &nbsp;
            <a onclick="return confirm('Are you sure to delete?')" href="?delproduct=<?php echo $result['id']; ?>">
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
