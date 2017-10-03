<?php include 'inc/header.php'; ?>
<?php
  include 'classes/Product.php';
  $product = new Product();
  include_once 'helper/Format.php';
  $fm = new Format();
?>
<?php
  if (isset($_GET['pId']) == NULL) {
    echo "<script>window.location = 'view-product-list.php'; </script>";
  }else{
    $id = $_GET['pId'];
  }
?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php
            $getProduct = $product->getProductById($id);
            if ($getProduct) {
              while ($result = $getProduct->fetch_assoc()) {
                ?>
          <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3>Product Name: <?php echo $result['title']; ?></h3>
              </div>
              <div class="panel-body">
                <p align="justify"><strong>Description:</strong> <?php echo $result['description']; ?></p>
                <p><strong>Date:</strong> <?php echo $result['entrydate']; ?></p>
                <p><strong>Available:</strong> <?php echo $result['stock']; ?> Pcs</p>

                <?php if($result['color'] != NULL){?>
                <p><strong>Color:</strong> <?php echo $result['color']; ?></p>
                <?php } ?>

                <?php if($result['size'] != NULL){?>
                <p><strong>Size:</strong> <?php echo $result['size']; ?></p>
                <?php } ?>
                
                <p><strong>Price:</strong> $<?php echo $result['sell']; ?></p>
              </div>   
          </div>
          </div>
        
      <?php
              }
            }
        ?>
    </div>
   </div>
</div>  

<?php include 'inc/footer.php'; ?>

