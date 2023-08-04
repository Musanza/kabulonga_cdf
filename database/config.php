<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'connect.php';

if (isset($_POST['login'])) {
	$user = $_POST['email'];
	$password = md5($_POST['password']);
	$query = "SELECT * FROM `users` WHERE email = '$user' AND password = '$password'";
	$fetch = $mysqli->query($query) or die($mysqli->error.__LINE__);
	$num_id = $fetch->num_rows;
	if ($num_id > 0) {
		$row = $fetch->fetch_assoc();
		$_SESSION['id'] = $row['id'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['role'] = $row['role'];
		$success = 'Login successful!';
		header('Refresh: 2; URL = admin/dashboard.php');
	} else {
		$error = 'Query failed. Account does not exist.';
	}
}

if (isset($_POST['add-user'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$role = $_POST['role'];
	$pass_1 = md5($_POST['password1']);
	$pass_2 = md5($_POST['password2']);

	if (empty($pass_1)) {
		$error = 'Please enter password.';
	} else{
		if ($pass_1 != $pass_2) {
			$error = 'Passwords do not match. Please check your entries.';
		} else {
			$query = "INSERT INTO `users` (name, email, phone, role, password) VALUES('$name', '$email', '$phone', '$role', '$pass_1')";
			$insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
			if($insert_row){
				$success = 'User added successfully';
					// header('Refresh: 2; URL = dashboard.php');
			} else {
				$error = 'Something went wrong. Please check your post and try again';
			}
		}
	}
}

if (isset($_POST['update-user'])) {
	$user_id = $_POST['user-id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$role = $_POST['role'];

	$query = "UPDATE `users` SET name='$name', email='$email', phone='$phone', role='$role' WHERE id = '$user_id'";
	$update_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($update_row){
		$success = 'Updated successfully';
					// header('Location: manage.php?man_project='.$pro_id);
	} else {
		$error = 'Something went wrong. Please check your entries and try again';
	}
}

if (isset($_POST['update-password'])) {
	$user_id = $_POST['user-id'];
	$pass_1 = md5($_POST['password1']);
	$pass_2 = md5($_POST['password2']);

	$query = "SELECT password FROM `users` WHERE id = '$user_id'";
	$fetch = $mysqli->query($query) or die($mysqli->error.__LINE__);
	$data = $fetch->fetch_assoc();
	$password = $data['password'];

	if ($password != $pass_1) {
		$error = 'Old password is incorrect. Please try again.';
	} else {
		$query = "UPDATE `users` SET password='$pass_2' WHERE id = '$user_id'";
		$update_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
		if($update_row){
			$success = 'Updated successfully';
					// header('Location: manage.php?man_project='.$pro_id);
		} else {
			$error = 'Something went wrong. Please try again';
		}
	}
}


if (isset($_POST['add-project'])) {
	$title = $_POST['title'];
	$description = $_POST['description'];
	$image_dir = '../assets/project-images/';
	$file_name = basename($_FILES['image']['name']);
	$tmp_name = $_FILES['image']['tmp_name'];
	$target_image_path = $image_dir . $file_name;
	$image_type = pathinfo($target_image_path, PATHINFO_EXTENSION);
	if (!empty($file_name)) {
		$allow_type = array('jpg', 'png', 'jpeg');
		if (in_array($image_type, $allow_type)) {
			// $query = "INSERT INTO `project`(title, description, image) VALUES('$title', '$description', '$file_name')";
			// 	$insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
			// 	if($insert_row){
			// 		$success = 'Project added successfully';
			// 	} else {
			// 		$error = 'Something went wrong. Please check your post and try again';
			// 	}
			if (move_uploaded_file($tmp_name, $target_image_path)) {
				$query = "INSERT INTO `project`(title, description, image) VALUES('$title', '$description', '$file_name')";
				$insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
				if($insert_row){
					$success = 'Project added successfully';
					header('Refresh: 2; URL = dashboard.php');
				} else {
					$error = 'Something went wrong. Please check your post and try again';
				}

				// $success = 'Image uploaded successfully';
			} else {
				$error = 'Image not uploaded. Try to check permissions';
			}
		} else {
			$error = 'Uploaded file is not allowed. Only jpg, jpeg and png files are allowed';
		}
	}
	
}

if (isset($_POST['update-project'])) {
	$pro_id = $_POST['pro_id'];
	$default_image = $_POST['default_image'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$image_dir = '../assets/project-images/';
	$file_name = basename($_FILES['image']['name']);
	$tmp_name = $_FILES['image']['tmp_name'];
	$target_image_path = $image_dir . $file_name;
	$image_type = pathinfo($target_image_path, PATHINFO_EXTENSION);
	if (!empty($file_name)) {
		$allow_type = array('jpg', 'png', 'jpeg');
		if (in_array($image_type, $allow_type)) {
			// if (empty($_FILES['image'])) {
			// 	$query = "UPDATE `project` SET title='$title', description='$description', image='$default_image' WHERE id = '$pro_id'";
			// 	$update_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
			// 	if($update_row){
			// 		$success = 'Project updated successfully';
			// 		header('Location: manage.php?man_project='.$pro_id);
			// 	} else {
			// 		$error = 'Something went wrong. Please check your post and try again';
			// 	}
			// } 
			// else{
			if (move_uploaded_file($tmp_name, $target_image_path)) {
				$query = "UPDATE `project` SET title='$title', description='$description', image='$file_name' WHERE id = '$pro_id'";
				$update_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
				if($update_row){
					$success = 'Project updated successfully';
					header('Location: manage.php?man_project='.$pro_id);
				} else {
					$error = 'Something went wrong. Please check your post and try again';
				}

				// $success = 'Image uploaded successfully';
			} else {
				$error = 'Image not uploaded. Try to check permissions';				
			}

		} else {
			$error = 'Uploaded file is not allowed. Only jpg, jpeg and png files are allowed';
		}
	} else{
		$query = "UPDATE `project` SET title='$title', description='$description', image='$default_image' WHERE id = '$pro_id'";
		$update_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
		if($update_row){
			$success = 'Project updated successfully';
			header('Location: manage.php?man_project='.$pro_id);
		} else {
			$error = 'Something went wrong. Please check your post and try again';
		}
	}
	
}

if (isset($_GET['del_project'])) {
	$delete_id = $_GET['del_project'];
	$query = "DELETE FROM `project` WHERE md5(id) = '$delete_id'";
	$delete_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($delete_row){
		$success = 'Deleted successfully';
		header("Location: ../admin/dashboard.php");
	} else {
		$error = 'Error occured. Try again';
	}
}

if (isset($_POST['add-category'])) {
	$pro_id = $_POST['pro_id'];
	$categories_arr = $_POST['category'];

	foreach ($categories_arr as $key => $category) {

		if ($category !="") {
			$query = "INSERT INTO `category`(pro_id, category) VALUES('$pro_id', '$category')";
			$insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
			if($insert_row){
				$success_cat = 'Categories added successfully';
			// header('Location: manage.php#category');
			} else {
				$error_cat = 'Something went wrong. Please check your post and try again';
			}
		}
	}
}

if (isset($_GET['del_category'])) {
	$delete_id = $_GET['del_category'];
	$pro_id = $_GET['pro_id'];
	$query = "DELETE FROM `category` WHERE id = '$delete_id'AND pro_id = '$pro_id'";
	$delete_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($delete_row){
		$success = 'Deleted successfully';
		header('Location: ../admin/manage.php?man_project='.$pro_id);
	} else {
		$error = 'Error occured. Try again';
	}
}

if (isset($_POST['add-feature'])) {
	$pro_id = $_POST['pro_id'];
	$features_arr = $_POST['feature'];
	$progress_arr = $_POST['progress'];

	foreach (array_combine($features_arr, $progress_arr) as $feature => $progress) {

		if ($feature !="") {
			$query = "INSERT INTO `features`(pro_id, feature, progress) VALUES('$pro_id', '$feature', '$progress')";
			$insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
			if($insert_row){
				$success_feat = 'Feature(s) added successfully';
				header('Location: manage.php?man_project='.$pro_id);
			} else {
				$error_feature = 'Something went wrong. Please check your post and try again';
			}
		}
	}
}

if (isset($_POST['update-feature'])) {
	$pro_id = $_POST['pro_id'];
	$features_arr = $_POST['feature'];
	$progress_arr = $_POST['progress'];

	foreach (array_combine($features_arr, $progress_arr) as $feature => $progress) {

		if ($feature !="") {
			$query = "UPDATE `features` SET feature='$feature', progress='$progress' WHERE pro_id='$pro_id'";
			$update_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
			if($update_row){
				$success_feat = 'Feature(s) updated successfully';
				header('Location: manage.php?man_project='.$pro_id);
			} else {
				$error_feature = 'Something went wrong. Please check your post and try again';
			}
		}
	}
}

if (isset($_GET['del_feature'])) {
	$delete_id = $_GET['del_feature'];
	$pro_id = $_GET['pro_id'];
	$query = "DELETE FROM `features` WHERE id = '$delete_id'";
	$delete_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
	if($delete_row){
		$success = 'Deleted successfully';
		header('Location: ../admin/manage.php?man_project='.$pro_id);
	} else {
		$error = 'Error occured. Try again';
	}
}
?>