<div class="col-md-12 category card bg-light" id="category">
  <form method="post">
    <input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>">
  <div>
    <br>
    <p>CATEGORIES</p>
    <div class="row">
      <div class="col-md-6">
        <fieldset class="form-group">

          <!-- Selected categories -->
          <p class="mt-4">Categories</p>
          <?php
          $query = "SELECT * FROM `category` WHERE pro_id ='$pro_id' GROUP BY category ORDER BY category ASC";
          $fetch = $mysqli->query($query) or die($mysqli->error.__LINE__);
          while($row = $fetch->fetch_assoc()){
            $id = $row['id'];
            $pro_id = $row['pro_id']; 
            $cat_name = $row['category'];?>
            <a href="../database/config.php?del_category=<?php echo $id; ?> && pro_id=<?php echo $pro_id; ?>" onclick="return confirm('This action cannot be reversed. Do you want to continue?')" class="btn text-capitalize"> <i class="fa fa-trash text-danger"></i> <?php echo $cat_name; ?>
            </a>
          <?php } ?>

          <p class="mt-4">Select  categories</p>
          <?php
          $sql = "SELECT * FROM `category` WHERE pro_id !='$pro_id' GROUP BY category ORDER BY category ASC";
          $select = $mysqli->query($sql) or die($mysqli->error.__LINE__);
          while($data = $select->fetch_assoc()){
            $pro_id = $data['pro_id']; 
            $cat_name = $data['category']; ?>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="<?php echo $cat_name; ?>" name="category[]" value="<?php echo $cat_name; ?>">
                <label class="form-check-label" for="<?php echo $cat_name; ?>"><?php echo $cat_name; ?></label>
            </div>
          <?php } ?>
        </fieldset>
      </div>
      <div class="col-md-6">
        <fieldset class="form-group">
          <p class="mt-4">Add category</p>

          <!-- Add category row -->
          <div class="form-group">
            <input type="text" name="category[]" class="form-control" placeholder="Category name" />
          </div>

          <!-- Add category row -->
          <br>
          <div class="form-group">
            <input type="text" name="category[]" class="form-control" placeholder="Category name" />
          </div>

          <!-- Add category row -->
          <br>
          <div class="form-group">
            <input type="text" name="category[]" class="form-control" placeholder="Category name" />
          </div>

          <!-- Add category row -->
          <br>
          <div class="form-group">
            <input type="text" name="category[]" class="form-control" placeholder="Category name" />
          </div>
        </fieldset>
      </div>
    </div>
    <br>
    <?php if (isset($success_cat)) { ?>
      <div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Horay!</strong> <?php echo $success_cat; ?>
      </div>
    <?php } if (isset($error_cat)) { ?>
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Oh snap!</strong> <?php echo $error_cat; ?>
      </div>
    <?php } ?>
    <input type="submit" name="add-category" value="Add Categories" class="btn btn-info">
    <br><br />
  </div>
</form>
</div>