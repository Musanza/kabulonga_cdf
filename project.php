<?php
session_start();
include 'database/config.php';
$project = $_GET['project'];

$query = "SELECT * FROM `project` WHERE md5(id) = '$project'";
$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
$row = $select->fetch_assoc();
  $pro_id = $row['id'];
  $title = $row['title'];
  $description = $row['description'];
  $image_url = 'assets/project-images/'.$row['image']; 
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   <title><?php echo $title; ?> | Kabulongo CDF Projects</title>
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
            <a class="nav-link" href="sign-in.php">Sign In</a>
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
     <h5 class="text-success"><?php echo $title; ?></h5>
     <div class="image-responsive">
      <img src="<?php echo $image_url; ?>" alt="Image not found" onerror="this.src='assets/project-images/default-image.jpg';">
    </div>
    <div class="info"><?php echo $description; ?></div>
  </div>
  <div class="col-md-7">
    <div id="myChart" style="max-width:100%; height:400px"></div>
  </div>
</div>
</div>
<!-- Footer -->
<?php include 'widgets/footer.php'; ?>
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