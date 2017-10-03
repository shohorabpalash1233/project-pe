<?php include 'inc/header.php'; ?>
<?php
    include 'classes/Category.php';
    $cat = new Category();
?>
<?php

    if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
        echo "<script>window.location = 'view-category.php'; </script>";
    } else {
        $id = $_GET['catId'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $catName = $_POST['catName'];

        $updateCategory = $cat->categoryUpdate($catName, $id);
    }
?>
<div class="container">
<?php
    if (isset($updateCategory)) {?>
    <div class="alert alert-success col-lg-6 col-lg-push-3 text-center">
        <?php echo $updateCategory;?>
    </div>
<?php       
    }
?>


<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron">
        <h2>Update Category</h2>
          <?php
            $getCategoryById = $cat->getCatById($id);
            if ($getCategoryById) {
              while ($result = $getCategoryById->fetch_assoc()) {
          ?>
        <form action="" method="POST" accept-charset="utf-8">
                <div class="form-group">
                  <label>Category Name</label>
                  <input type="text" class="form-control" name="catName" value="<?php echo $result['catName']; ?>">
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

<?php include 'inc/footer.php'; ?>