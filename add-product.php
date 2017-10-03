<?php 
    include 'inc/header.php';
    include 'classes/Category.php';
    include 'classes/Product.php';

    $cat = new Category();
    $product = new Product();

 ?>

<?php



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $title        = $_POST['title'];
        $description  = $_POST['description'];
        $catId        = $_POST['catId'];
        $entrydate    = $_POST['entrydate'];
        $size         = $_POST['size'];
        $color        = $_POST['color'];
        $stock        = $_POST['stock'];
        $purchase     = $_POST['purchase'];
        $sell         = $_POST['sell'];

        if ($title == "" || $description == "" || $catId == "" || $entrydate == "" || $stock == "" || $purchase == "" ||   $sell == "") {

          echo "<div class='alert alert-success col-lg-6 col-lg-push-3 text-center'>
                    Fields Must Not Be Empty!
                </div>";

          }else{
    
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

        
         if (file_exists('product-add.json')) {

           $extra = array(

            'title'       => $title,
            'description' => $description,
            'catId'       => $catId,
            'entrydate'   => $entrydate,
            'size'        => $size,
            'color'       => $color,
            'stock'       => $stock,
            'purchase'    => $purchase,
            'sell'        => $sell

           );

           $arrayData[] =  $extra;

           $finalData = json_encode($arrayData);

           if (file_put_contents('product-add.json', $finalData)) {

              echo "<span class='alert alert-success col-lg-6 col-lg-push-3 text-center'>
                    Product Added Successfully!
              </span>";

           }


         }else{

            echo "JSON File not exists";

         }


         $jsonData = file_get_contents('product-add.json');
         $data = json_decode($jsonData, true);

          foreach ($data as $value) {

            $title        = $value['title'];
            $description  = $value['description'];
            $catId        = $value['catId'];
            $entrydate    = $value['entrydate'];
            $size         = $value['size'];
            $color        = $value['color'];
            $stock        = $value['stock'];
            $purchase     = $value['purchase'];
            $sell         = $value['sell'];
          }
          $insertProduct = $product->insertProduct($title, $description, $catId, $entrydate, $size, $color, $stock, $purchase, $sell);
      }
    }
?>



<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron">

        <h2>Add Product</h2>
        <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Product Title</label>
                  <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea rows="10" name="description" class="form-control"></textarea>
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
                    <option value="<?php echo $result['catId'];?>">
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
                  <input type="text" id="datepicker" name="entrydate">
                </div>
                <div class="form-group">
                  <label>Size</label> ( <span>Use comma to add more</span> )
                  <input type="text" class="form-control" id="size" name="size[]">
                </div>
                <div class="form-group">
                  <label>Color</label> ( <span>Use comma to add more</span> )
                  <input type="text" class="form-control" id="color" name="color[]">
                </div>
                <div class="form-group">
                  <label>Stock Quantity</label>
                  <input type="text" class="form-control" name="stock">
                </div>
                <div class="form-group">
                  <label>Purchase Price</label>
                  <input type="text" class="form-control" name="purchase">
                </div>
                <div class="form-group">
                  <label>Selling Price</label>
                  <input type="text" class="form-control" name="sell">
                </div>
                <input type="submit" value="Add" class="btn btn-primary">
        </form>
    </div>
  </div>
</div>      

<?php include 'inc/footer.php'; ?>
