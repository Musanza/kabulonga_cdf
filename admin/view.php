<?php 
session_start();
include '../database/config.php';
if (!isset($_SESSION['name'])) {
  header("location: ../sign-in.php");
}

$user = $_SESSION['name'];

$project = $_GET['view_project'];
$query = "SELECT title FROM `project` WHERE md5(id) = '$project'";
$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
$row = $select->fetch_assoc();
$display_title = $row['title'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<title><?php echo $display_title; ?> | Kabulongo CDF Projects</title>
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
<div class="pad-top-50"></div>
<!-- Project -->
<div class="container">
	<div class="row">
		<div class="col-md-5">
      <?php
      $query = "SELECT * FROM `project` WHERE md5(id) = '$project'";
      $select = $mysqli->query($query) or die($mysqli->error.__LINE__);
      while($row = $select->fetch_assoc()){
        $title = $row['title'];
        $description = $row['description'];
        $image_url = '../assets/project-images/'.$row['image']; 
        ?>
			<h5 class="text-success"><?php echo $title; ?></h5>
      <div class="image-responsive">
            <img src="<?php echo $image_url; ?>" alt="Image not found" onerror="this.src='../assets/project-images/default-image.jpg';">
          </div>
      <div class="info"><?php echo $description; ?></div>
    <?php } ?>
		</div>
		<div class="col-md-7">
      <div id="myChart" style="max-width:100%; height:400px"></div>
      <!-- <div class="comment-form">
        <form>
          <div class="form-group">
          <div class="label">Comment</div>
          <textarea name="comment" class="form-control" required></textarea>
        </div>
        <br>
        <input type="submit" name="send-comment" class="btn btn-primary" value="Send">
        </form>
      </div> -->
    </div>
	</div>
</div>
<!-- Footer -->
<?php include '../widgets/footer.php'; ?>
<!-- End footer -->
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
google.charts.load('current',{packages:['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Your Function
function drawChart() {

// Set Data
const data = google.visualization.arrayToDataTable([
  ['Feature', '(%)'],
  <?php
      $query = "SELECT * FROM `features` WHERE md5(pro_id) = '$project' ORDER BY feature ASC";
      $fetch = $mysqli->query($query) or die($mysqli->error.__LINE__);
      while($data = $fetch->fetch_assoc()){
        echo "['".$data['feature']."', ".$data['progress']."],";
        } ?>
]);

// Set Options
const options = {
  title: 'Project progress'
};

// Draw
const chart = new google.visualization.BarChart(document.getElementById('myChart'));
chart.draw(data, options);

}
</script>
</body>
</html>