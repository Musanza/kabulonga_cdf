<?php 
session_start();
include '../database/config.php';
if (!isset($_SESSION['name'])) {
  header("location: ../sign-in.php");
}

$user = $_SESSION['name'];
$my_id = $_SESSION['id'];
$query = "SELECT * FROM `users` WHERE id = '$my_id'";
$select = $mysqli->query($query) or die($mysqli->error.__LINE__);
$row = $select->fetch_assoc();
$u_name = $row['name'];
$u_email = $row['email'];
$u_phone = $row['phone'];
$u_role = $row['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
  <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-6.4.0-web/css/all.css">
  <title><?php echo $user; ?> | Kabulongo CDF Projects</title>
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
            <a class="nav-link active" href="profile.php">Hi, <?php echo $user; ?></a>
            <span class="visually-hidden">(current)</span>
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
  <div class="container pad-top-50">
    <div class="row">
      <div class="col-md-2"></div>
      <!-- User info -->
      <div class="col-md-4">
        <form method="post">
          <fieldset class="form-group">
            <!-- Form post responses -->
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

            <input type="hidden" name="user-id" value="<?php echo $my_id; ?>">
            <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="Full name" value="<?php echo $u_name; ?>" required />
            </div>
            <br>
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Email address" value="<?php echo $u_email; ?>" required />
            </div>
            <br>
            <div class="form-group">
              <input type="text" name="phone" class="form-control" placeholder="Phone number" value="<?php echo $u_phone; ?>" required />
            </div>
            <br>
            <div class="form-group">
              <?php if ($_SESSION['role'] == 'Admin') {?>
              <select name="role" class="form-control" required>
                <option><?php echo $u_role; ?></option>
                <option>Member</option>
              </select>
            <?php } else{?>
              <select name="role" class="form-control" required disabled>
                <option><?php echo $u_role; ?></option>
              </select>
            <?php }?>
            </div>
            <br>
            <input type="submit" name="update-user" class="btn btn-success" value="Update User">
          </fieldset>
        </form>
      </div>

      <!-- User password -->
      <div class="col-md-4 card password-card bg-light">
        <form method="post">
          <fieldset class="form-group">
            <input type="hidden" name="user-id" value="<?php echo $my_id; ?>">
            <div class="form-group">
              <input type="password" name="password1" class="form-control" placeholder="Old password" />
            </div>
            <br>
            <div class="form-group">
              <input type="password" name="password2" class="form-control" placeholder="New password" />
            </div>
            <br>
            <input type="submit" name="update-password" class="btn btn-info" value="Update Password">
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <div class="manage-project"></div>
  <?php include '../widgets/footer.php'; ?>
  <script type="text/javascript" src="../assets/fontawesome-free-6.4.0-web/js/all.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- End footer -->
</body>
</html>