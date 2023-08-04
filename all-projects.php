<?php
session_start();
include 'database/config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
  <link rel="stylesheet" type="text/css" href="assets/fontawesome-free-6.4.0-web/css/all.css">
  <title>All Projects | Kabulongo CDF Projects</title>
</head>
<body>
	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg bg-light" data-bs-theme="light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Kabulongo Ward</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor03">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="all-projects.php">All Projects</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="sign-in.php">Sign In</a>
            <span class="visually-hidden">(current)</span>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End navigation -->

  <!-- All Prjects -->
  <div class="container pad-top-50 all-projects">
    <div class="row">

      <!-- Gridview -->
      <div class="col-md-9 gridview">
        <div class="row">
          <?php
          $query = "SELECT * FROM `project` ORDER BY id DESC";
          $select = $mysqli->query($query) or die($mysqli->error.__LINE__);
          while($row = $select->fetch_assoc()){
            $pro_id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $image_url = 'assets/project-images/'.$row['image']; 
            ?>
            <div class="col-md-4">
              <div class="image-responsive">
                <img src="<?php echo $image_url; ?>" alt="Image not found" onerror="this.src='assets/project-images/default-image.jpg';">
                <h6 class="text-success title"><a href="project.php?project=<?php echo md5($pro_id); ?>"><?php echo $title; ?></a></h6>
                <p>
                  <?php if (strlen($description) > 99){
                   echo $description = substr($description, 0, 100) . '...';
                 } else {
                  echo $description;
                } ?>
              </p>
              <a href="project.php?project=<?php echo md5($pro_id); ?>" class="btn btn-primary">Read more</a>
              <hr>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-md-3 sidebar">
      <h5>Catetory</h5>
      <ul class="catetory">
        <?php
        $query = "SELECT * FROM `category` GROUP BY category ORDER BY category ASC";
        $fetch = $mysqli->query($query) or die($mysqli->error.__LINE__);
        while($row = $fetch->fetch_assoc()){?>
          <li><a href="all-projects.php?catetory=<?php echo $row['category']; ?>"><?php echo $row['category']; ?></a></li>
        <?php } ?>
      </ul>
      <h5>What's New</h5>
      <?php
      $query = "SELECT * FROM `project` ORDER BY id DESC LIMIT 4";
      $select = $mysqli->query($query) or die($mysqli->error.__LINE__);
      while($row = $select->fetch_assoc()){
        $pro_id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $image_url = 'assets/project-images/'.$row['image']; 
        ?>

        <!-- Data -->
        <a href="project.php?project=<?php echo md5($pro_id); ?>">
          <div class="row whats-new">
            <div class="col-md-3">
              <div class="image-responsive">
                <img src="<?php echo $image_url; ?>" alt="Image not found" onerror="this.src='assets/project-images/default-image.jpg';">
              </div>
            </div>
            <div class="col-md-9">
              <h6><?php echo $title; ?></h6>
              <p>
                <?php if (strlen($description) > 49){
                 echo $description = substr($description, 0, 50) . '...';
               } else {
                echo $description;
              } ?>
            </p>
          </div>
        </div>
      </a>
    <?php } ?>
  </div>
</div>
</div>
<!-- Footer -->
<?php include 'widgets/footer.php'; ?>
<script type="text/javascript" src="assets/fontawesome-free-6.4.0-web/js/all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- End footer -->
</body>
</html>