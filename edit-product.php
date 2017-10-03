<?php 
    include 'inc/header.php';
    include 'classes/Category.php';
    include 'classes/Product.php';
    $cat = new Category();
    $product = new Product();
 ?>
<?php

    if (!isset($_GET['pId']) || $_GET['pId'] == NULL) {
        echo "<script>window.location = 'view-product.php'; </script>";
    } else {
        $id = $_GET['pId'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $size = $_POST['size'];
    
        $i=0;
        if(is_array($size))
        {
          foreach($size as $key=>$val)
          {
            $arr[$i] = $val;
            $i++;
          }
        }
        
        $size = implode(",",$arr);

        $color = $_POST['color'];
    
        $j=0;
        if(is_array($color))
        {
          foreach($color as $key=>$val)
          {
            $arr[$j] = $val;
            $i++;
          }
        }
        
        $color = implode(",",$arr);

        $updateProduct = $product->productUpdate($_POST, $size, $color, $id);
    }
?>
<div class="container">
<?php
    if (isset($updateProduct)) {?>
    <div class="alert alert-success col-lg-6 col-lg-push-3 text-center">
        <?php echo $updateProduct;?>
    </div>
<?php       
    }
?>
</div>  
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron">

        <h2>Add Product</h2>
        <?php
            $getProduct = $product->getProductById($id);
            if ($getProduct) {
                while ($value = $getProduct->fetch_assoc()) {                      
        ?>
        <form action="" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Product Title</label>
                  <input type="text" class="form-control" name="title" value="<?php echo $value['title']; ?>">
                </div>
                <div class="form-group">
                  <label>Description</label>
    <textarea rows="10" name="description" class="form-control"><?php echo $value['description'];?></textarea>
                </div>
                <div class="form-group">
                  <label>Category</label>
                   <select id="select" name="catId" class="form-control">
                      <option>Select Category</option>
                    <?php
                        $getCat = $cat->getAllCategory();
                        if ($getCat) {
                            while ($result = $getCat->fetch_assoc()) {
                    ?>
                    <option
                      <?php
                          if ($value['catId'] == $result['catId']) {?>
                          selected = "selected"<?php  }?> value="<?php echo $result['catId'];?>">
                      <?php echo $result['catName'];?>   
                    </option>
                    <?php
                        }
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                  <label>Date</label>
                  <input type="text" id="datepicker" name="entrydate" value="<?php echo $value['entrydate']; ?>">
                </div>
                <div class="form-group">
                  <label>Size</label>
                  <input type="text" class="form-control" id="size" name="size[]" value="<?php echo $value['size']; ?>">
                </div>
                <div class="form-group">
                  <label>Color</label>
                  <input type="text" class="form-control" id="color" name="color[]" value="<?php echo $value['color']; ?>">
                </div>
                <div class="form-group">
                  <label>Stock Quantity</label>
                  <input type="text" class="form-control" name="stock" value="<?php echo $value['stock']; ?>">
                </div>
                <div class="form-group">
                  <label>Purchase Price</label>
                  <input type="text" class="form-control" name="purchase" value="<?php echo $value['purchase']; ?>">
                </div>
                <div class="form-group">
                  <label>Selling Price</label>
                  <input type="text" class="form-control" name="sell" value="<?php echo $value['sell']; ?>">
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
