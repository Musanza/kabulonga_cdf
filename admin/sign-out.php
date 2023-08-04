<?php
   session_start();
   unset($_SESSION["id"]);
   unset($_SESSION["role"]);
   unset($_SESSION["users"]);
   session_unset();
   session_destroy();
   header('Refresh: 3; URL = ../sign-in.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
  <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-6.4.0-web/css/all.css">
  <title>Sign Out | Kabulongo CDF Projects</title>
</head>
<body>
  <main class="text-center sign-out">
  <div class="spinner-border" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<br>
<p class="text-primary">Logging you out. Please wait...</p>
 </main>
 <!-- Footer -->
<?php include '../widgets/footer.php'; ?>
<script type="text/javascript" src="../assets/fontawesome-free-6.4.0-web/js/all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- End footer -->
</body>
</html>