<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hello, World!</title>
	<link rel="stylesheet" href="framework/bootstrap.css">
	<link rel="stylesheet" href="style.css">
	<script src="framework/bootstrap.js" defer></script>
	<?php require_once("../src/db.php"); ?>
</head>
<body>
	<?php

	?>
	<h3>Price: <span class="fw-bold">&euro;<?= $price ?></span></h3>
	<form action="confirmation.php" method="post">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="firstName" name="firstName" placeholder="" required>
			<label for="firstName">First Name</label>
		</div>
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="lastName" name="lastName" placeholder="" required>
			<label for="lastName">Last Name</label>
		</div>
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="address" name="address" placeholder="" required>
			<label for="address">Address</label>
		</div>
		<input type="hidden" name="cpu"   value="<?= $cpu   ?>">
		<input type="hidden" name="gpu"   value="<?= $gpu   ?>">
		<input type="hidden" name="ram"   value="<?= $ram   ?>">
		<input type="hidden" name="box"   value="<?= $box   ?>">
		<input type="hidden" name="total" value="<?= $price ?>"> <!-- This is insecure. Too bad -->
		<input class="btn btn-primary" type="submit" value="Order">
		<button type="button" class="btn btn-outline-primary" onclick="window.location = '/'">Back</button>
	</form>
	<a href="#" class="position-absolute top-0 end-0 text-muted">Login</a>
</body>
