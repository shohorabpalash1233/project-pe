<?php 
    include 'inc/header.php';
    include 'classes/Category.php';

    $cat = new Category();
 ?> 

 <?php
  if (isset($_GET['delcategory'])) {
    $id = $_GET['delcategory'];
    $delcategory = $cat->delCategoryById($id);
  }
?>
 
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron">


      <?php
        $getCategory = $cat->getAllCategory();
        if (!$getCategory){
          ?>
          <div class="panel panel-body text-center">
            <h2>No Category Available</h2>
          </div>
          <?php
        } else {
          ?>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
          <?php
          $i = 0;
          while ($result = $getCategory->fetch_assoc()) {
            $i++;
          
      ?>

      <tbody>

        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $result['catName']; ?></td>
          <td>
            <a href="edit-category.php?catId=<?php echo $result['catId']; ?>">
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a> 
            &nbsp;
            <a onclick="return confirm('Are you sure to delete?')" href="?delcategory=<?php echo $result['catId']; ?>">
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
