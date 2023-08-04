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
	<title></title>
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
<!-- Sign In -->
<div class="vh-25"></div>
<div class="container">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <h3>LOGIN</h3>
      <div class="form">
        <form method="post">
          <div class="form-group">
            <label>Email address</label>
            <input type="email" name="email" class="form-control" required />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required />
          </div>
          <p>Forgot password? <span><a href="forgot-password.php">Reset</a></span></p>
          <?php if (isset($success)) { ?>
                        <div class="spinner-border" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                    <?php } if (isset($error)) { ?>
                      <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Oh snap!</strong> <?php echo $error; ?>
                        </div>
                      <?php } ?>
          <input type="submit" name="login" class="btn btn-primary" value="LOGIN">
        </form>
      </div>
    </div>
  </div>
</div>
<div class="vh-25"></div>
<!-- Footer -->
<?php include 'widgets/footer.php'; ?>
<script type="text/javascript" src="assets/fontawesome-free-6.4.0-web/js/all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- End footer -->
</body>
</html>