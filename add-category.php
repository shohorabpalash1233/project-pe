<?php include 'inc/header.php'; ?>
<?php
    include 'classes/Category.php';
?>
<?php
    $cat = new Category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];

        $insertCat = $cat->catAdd($catName);
    }
?>
<div class="container">
<?php
    if (isset($insertCat)) {?>
    <div class="alert alert-success col-lg-6 col-lg-push-3 text-center">
        <?php echo $insertCat;?>
    </div>
<?php       
    }
?>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron">
        <h2>Add Category</h2>
        <form action="" method="POST" accept-charset="utf-8">
                <div class="form-group">
                  <label>Category Name</label>
                  <input type="text" class="form-control" name="catName" placeholder="Enter Category Name">
                </div>
                <input type="submit" value="Add" class="btn btn-primary">
        </form>
    </div>
  </div>
</div> 
     

<?php include 'inc/footer.php'; ?>