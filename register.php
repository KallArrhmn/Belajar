<?php

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
	header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Register Form</title>
	<style>
		body {
			background-image: url('2.jpg');
			background-size: cover;
			background-position: center;
		}

		.container {
			max-width: 400px;
			margin: auto;
			padding: 20px;
			background: rgba(255, 255, 255, 0.8);
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		.login-text {
			text-align: center;
			font-size: 2rem;
			font-weight: 800;
			margin-bottom: 20px;
		}

		.input-group {
			margin-bottom: 15px;
		}

		.input-group input {
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}

		.btn {
			width: 100%;
			padding: 10px;
			background-color: #5cb85c;
			border: none;
			border-radius: 5px;
			color: white;
			font-size: 1rem;
			cursor: pointer;
		}

		.btn:hover {
			background-color: #4cae4c;
		}

		.login-register-text {
			text-align: center;
			margin-top: 15px;
		}
	</style>
</head>

<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="index.php">Login Here</a>.</p>
		</form>
	</div>
</body>

</html>