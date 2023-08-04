<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../database/config.php';
if (!isset($_SESSION['name'])) {
  header("location: ../sign-in.php");
}

$user = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
  <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-6.4.0-web/css/all.css">
  <title>Dashboard | Kabulongo CDF Projects</title>
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
            <a class="nav-link active" href="dashboard.php">Dashboard
              <span class="visually-hidden">(current)</span>
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

  <!-- All projects -->
  <div class="container pad-top-50">
    <div class="row">
      <?php
      $query = "SELECT * FROM `project` ORDER BY id DESC";
      $select = $mysqli->query($query) or die($mysqli->error.__LINE__);
      while($row = $select->fetch_assoc()){
        $pro_id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $image_url = '../assets/project-images/'.$row['image']; 
        ?>
        <!-- Data -->
        <div class="col-md-4">
          <div class="card">
            <div class="image-responsive">
            <img src="<?php echo $image_url; ?>" alt="Image not found" onerror="this.src='../assets/project-images/default-image.jpg';">
            <div class="card-body">
              <h6 class="text-success"><a href="view.php?view_project=<?php echo md5($pro_id); ?>"><?php echo $title; ?></a></h6>
            <p>
              <?php if (strlen($description) > 99){
                   echo $description = substr($description, 0, 100) . '...';
                 } else {
                  echo $description;
                } ?>
            </p>
            <div class="actions">
              <a href="view.php?view_project=<?php echo md5($pro_id); ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
              <?php if ($_SESSION['role'] == 'Admin') { ?>
                <a href="manage.php?man_project=<?php echo $pro_id; ?>" class="btn btn-dark"><i class="fa fa-gear"></i></a>
              <a href="../database/config.php?del_project=<?php echo md5($pro_id); ?>" onclick="return confirm('This action cannot be reversed. Do you want to continue?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
              <?php } ?>
            </div>
            </div>
          </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <!-- End all projects -->
  <!-- Footer -->
  <?php include '../widgets/footer.php'; ?>
  <script type="text/javascript" src="../assets/fontawesome-free-6.4.0-web/js/all.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- End footer -->
</body>
</html>