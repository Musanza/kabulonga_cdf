<?php 
session_start();
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
            <a class="nav-link" href="dashboard.php">Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add-project.php">Add Project</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="users.php">Users</a>
            <span class="visually-hidden">(current)</span>
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

      <!-- Users list -->
      <div class="col-md-8">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email address</th>
                <th>Phone number</th>
                <th>Role</th>
                <?php if ($_SESSION['role'] == 'Admin') {?>
                  <th rowspan="2">Action</th>
                <?php } ?>
              </tr>
            </thead>

            <tbody>
              <?php
              $query = "SELECT * FROM `users` ORDER BY name ASC";
              $fetch = $mysqli->query($query) or die($mysqli->error.__LINE__);
          // $num_id = $fetch->num_rows;
              while($row = $fetch->fetch_assoc()){ ?>
                <tr>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['phone']; ?></td>
                  <td><?php echo $row['role']; ?></td>
                  <?php if ($_SESSION['role'] == 'Admin') {?>
                   <td>
                    <a href="users.php?update_user=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                  </td>
                  <td>
                    <a href="../database/config.php?del_user=<?php echo md5($row['id']); ?>" onclick="return confirm('This action cannot be reversed. Do you want to continue?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                  </td>
                <?php  } ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

    <?php if ($_SESSION['role'] == 'Admin') {?>
     <!-- Manage user -->
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

          <?php if (isset($_GET['update_user'])) {
            $user_id = $_GET['update_user'];
            $query = "SELECT * FROM `users` WHERE id = '$user_id'";
            $select = $mysqli->query($query) or die($mysqli->error.__LINE__);
            $row = $select->fetch_assoc();
            $u_name = $row['name'];
            $u_email = $row['email'];
            $u_phone = $row['phone'];?>

            <input type="hidden" name="user-id" value="<?php echo $_GET['update_user']; ?>">
          <?php } ?>
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
            <select name="role" class="form-control" required>
              <?php if (isset($_GET['update_user'])) {
                $user_id = $_GET['update_user'];
                $query = "SELECT * FROM `users` WHERE id = '$user_id'";
                $select = $mysqli->query($query) or die($mysqli->error.__LINE__);
                $data = $select->fetch_assoc(); ?>
                <option><?php echo $data['role']; ?></option>
              <?php } else{?>
                <option>Select role</option>
              <?php } ?>
              <option>Admin</option>
              <option>Member</option>
            </select>
          </div>
          <br>
          <?php if (isset($_GET['update_user'])) { ?>
            <input type="submit" name="update-user" class="btn btn-success" value="Update User">
            <br><br />
          <?php } ?>
          <?php if (!isset($_GET['update_user'])) { ?>
            <div class="form-group">
              <input type="password" name="password1" class="form-control" placeholder="Password" />
            </div>
            <br>
            <div class="form-group">
              <input type="password" name="password2" class="form-control" placeholder="Confirm password" />
            </div>
          <?php } else{?>
            <div class="form-group">
              <input type="password" name="password1" class="form-control" placeholder="Old password" />
            </div>
            <br>
            <div class="form-group">
              <input type="password" name="password2" class="form-control" placeholder="New password" />
            </div>
            <br>
            <input type="submit" name="update-password" class="btn btn-info" value="Update Password">
          <?php } ?>
          <br>
          <?php if (!isset($_GET['update_user'])) { ?>
            <input type="submit" name="add-user" class="btn btn-primary" value="Add User">
          <?php } ?>
        </fieldset>
      </form>
    </div>
  <?php } ?>
</div>
</div>
<!-- Footer -->
<?php include '../widgets/footer.php'; ?>
<script type="text/javascript" src="../assets/fontawesome-free-6.4.0-web/js/all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- End footer -->
</body>
</html>