<?php
	require_once("../src/db.php");
	require_once("../src/account.php");

	$error = false;

	if(isset($_POST["username"]) && isset($_POST["password"])) {
		$error = !login($_POST["username"], $_POST["password"]);
		if(!$error) {
			header("Location: /");
		}
	}

	if(isset($_GET["logout"])) {
		logout();
		header("Location: login.php");
	}

	if(isLoggedIn()) {
		header('Location: /');
		exit();
	}
?>
<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hello, World!</title>
	<link rel="stylesheet" href="framework/bootstrap.css">
	<link rel="stylesheet" href="style.css">
	<script src="framework/bootstrap.js" defer></script>
</head>
<body>
	<form action="#" method="post" class="position-absolute top-50 start-50 translate-middle border rounded p-3">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="username" name="username" placeholder="" required>
			<label for="username">Username</label>
		</div>
		<div class="form-floating mb-3">
			<input type="password" class="form-control" id="password" name="password" placeholder="" required>
			<label for="password">Password</label>
		</div>
		<input class="btn btn-primary" type="submit" value="Login">
		<button type="button" class="btn btn-outline-primary" onclick="window.location = '/'">Back</button>
		<p>Dont have an account? <a href="register.php">Sign up!</a></p>
		<?php if($error) { ?>
			<br><br>
			<div class="p-3 mb-2 bg-danger-subtle border border-danger rounded">
				<p>Invalid username or password</p>
			</div>
		<?php } ?>
	</form>
</body>
</html>
