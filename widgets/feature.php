<br><br/>
<div class="col-md-12 card bg-dark feature">
  <div class="text-white">
    <br>
    <p>FEATURES</p>
    <!-- Row -->
    <div class="row">
      <!-- Project features -->
      <form method="post">
        <input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>">
        <fieldset class="form-group">

        <!-- Fetch features -->
        <p class="mt-4">Manage feature(s)</p>
        <?php
        $query = "SELECT * FROM `features` WHERE pro_id ='$pro_id' ORDER BY feature ASC";
        $fetch = $mysqli->query($query) or die($mysqli->error.__LINE__);
        $num_id = $fetch->num_rows;
        while($row = $fetch->fetch_assoc()){
          $id = $row['id'];
          $pro_id = $row['pro_id']; 
          $feature = $row['feature'];
          $progress = $row['progress'];
          ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" name="feature[]" class="form-control" value="<?php echo $feature; ?>" placeholder="Feature name" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="number" name="progress[]" class="form-control"value="<?php echo $progress; ?>" placeholder="Percentage">
              </div>
            </div>
            <!-- Delete feature -->
            <div class="col-md-2">
              <a href="../database/config.php?del_feature=<?php echo $id; ?> && pro_id=<?php echo $pro_id; ?>" onclick="return confirm('This action cannot be reversed. Do you want to continue?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </div>
          </div>
          <br>
        <?php } if ($num_id > 0) {?>
          <input type="submit" name="update-feature" value="Update Features" class="btn btn-success">
          <?php } ?>
          <br>
      </fieldset>
      </form>

      <form method="post">
        <input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>">
        <fieldset class="form-group">
          <!-- Add feature row -->
          <p class="mt-4">Add feature(s)</p>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" name="feature[]" class="form-control" value="<?php ?>" placeholder="Feature name" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="number" name="progress[]" class="form-control" placeholder="Percentage">
              </div>
            </div>
          </div>

          <!-- Add feature row -->
          <br>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" name="feature[]" class="form-control" value="<?php ?>" placeholder="Feature name" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="number" name="progress[]" class="form-control" placeholder="Percentage">
              </div>
            </div>
          </div>
        </fieldset>
        <br>
        <?php if (isset($success_feat)) { ?>
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Horay!</strong> <?php echo $success_feat; ?>
          </div>
        <?php } if (isset($error_feat)) { ?>
          <div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Oh snap!</strong> <?php echo $error_feat; ?>
          </div>
        <?php } ?>
        
        <input type="submit" name="add-feature" value="Add Features" class="btn btn-info">
        <br><br />
      </form>
    </div>
  </div>
</div>