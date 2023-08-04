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
	<title>Home | Kabulongo CDF Projects</title>
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
          <a class="nav-link active" href="index.php">Home
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="all-projects.php">All Projects</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sign-in.php">Sign In</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End navigation -->
<!-- Showcase -->
<div class="container showcase">
	<div class="row">
		<div class="col-md-4">
			<div class="lx-text text-success">CDF</div>
			<div class="l-text">Projects</div>
		</div>
		<div class="col-md-8 recent-projects">
      <div class="l-text text-success">What's New</div>
      <p>Here are the recently updated projects</p>
      <hr>
      <div class="row">
        <?php
          $query = "SELECT * FROM `project` ORDER BY id DESC LIMIT 3";
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
	</div>
</div>
<!-- Footer -->
<?php include 'widgets/footer.php'; ?>
<script type="text/javascript" src="assets/fontawesome-free-6.4.0-web/js/all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- End footer -->
</body>
</html>