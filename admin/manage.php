<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../database/config.php';
if (!isset($_SESSION['name'])) {
  header("location: ../sign-in.php");
}

$user = $_SESSION['name'];

$pro_id = $_GET['man_project'];
$query = "SELECT * FROM `project` WHERE id = '$pro_id'";
$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
$row = $select->fetch_assoc();
$title = $row['title'];
$image = $row['image'];
$description = $row['description'];
$image_url = '../assets/project-images/'.$image; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
  <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-6.4.0-web/css/all.css">
  <title><?php echo $title; ?> | Kabulongo CDF Projects</title>
</head>
<body>
	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg bg-light" data-bs-theme="light">
    <div class="container-fluid">
      <a class="navbar-brand" href="sign-out.php">Kabulongo Ward</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor03">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Hi, <?php echo $user; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add-project.php">Add Project</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users.php">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sign-out.php">Sign Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End navigation -->

  <!-- manage project -->
  <div class="contaner manage-project">
    <div class="row">
      <div class="col-md-6">
        <div class="form">
          <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>">
            <div class="form-group">
              <label>Title</label>
              <input type="text" name="title" class="form-control" value="<?php echo $title; ?>" />
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea name="description" class="form-control" >
                <?php echo $description; ?>
              </textarea>
            </div>
            <br>
            <div class="display-image">
              <img height="200" width="250" src="<?php echo $image_url; ?>" alt="Image not found" onerror="this.src='../assets/project-images/default-image.jpg';">
            </div>
            <br>
            <div class="form-group">
              <label>Image</label>
              <input type="hidden" name="default_image" value="<?php echo $image; ?>">
              <input type="file" name="image" />
            </div>
            <br>
            <?php if (isset($success)) { ?>
              <div class="alert alert-dismissible alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Horay!</strong> <?php echo $success; ?>
              </div>
            <?php } if (isset($error)) { ?>
              <div class="alert alert-dismissible alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Oh snap!</strong> <?php echo $error; ?>
              </div>
            <?php } ?>
            <input type="submit" name="update-project" class="btn btn-success" value="UPDATE">
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">

          <!-- Feature -->
          <?php include '../widgets/feature.php'; ?>
          <div class="mg-top-10"></div>
          <!-- Category -->
          <?php include '../widgets/category.php'; ?>
        </div>
      </div>
    </div>
    <!-- <div class="update-all">
      <input type="submit" name="update-all" class="btn btn-success" value="UPDATE ALL">
    </div> -->
  </div>
  <!-- Footer -->
  <?php include '../widgets/footer.php'; ?>
  <script type="text/javascript" src="../assets/fontawesome-free-6.4.0-web/js/all.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- End footer -->
</body>
</html>