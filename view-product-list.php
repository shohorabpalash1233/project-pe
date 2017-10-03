<?php include 'inc/header.php'; ?>
<?php
  include 'classes/Product.php';
  $product = new Product();
  include_once 'helper/Format.php';
  $fm = new Format();
?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php
            $getProduct = $product->getAllProduct();
            if (!$getProduct){
              ?>
              <div class="panel panel-body text-center">
                <h2>No Products Available</h2>
              </div>
              <?php
            }else{
              while ($result = $getProduct->fetch_assoc()) {

            ?>
          <div class="col-sm-6 col-md-4">
            <div class="panel panel-primary" style="height: 400px;">
              <div class="panel-heading">
                <h3>Product Name: <?php echo $result['title']; ?></h3>
              </div>
              <div class="panel-body">
                <p align="justify"><strong>Description:</strong> <?php echo $fm->textShorten($result['description'], 100); ?></p>
                <p><strong>Date:</strong> <?php echo $result['entrydate']; ?></p>
                <p><strong>Available:</strong> <?php echo $result['stock']; ?> Pcs</p>

                <?php if($result['color'] != NULL){?>
                <p><strong>Color:</strong> <?php echo $result['color']; ?></p>
                <?php } ?>

                <?php if($result['size'] != NULL){?>
                <p><strong>Size:</strong> <?php echo $result['size']; ?></p>
                <?php } ?>
                
                <p><strong>Price:</strong> $<?php echo $result['sell']; ?></p>
                <p><a href="view-single-product.php?pId=<?php echo $result['id']; ?>" class="btn btn-primary" role="button">See More</a></p>
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

