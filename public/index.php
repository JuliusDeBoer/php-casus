<?php
	require_once("../src/account.php");

	if(!isLoggedIn()) {
		header("Location: login.php");
	}

	$account = getAccount();
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
	<?php require_once("../src/products.php"); ?>
</head>
<body>
	<a href="login.php" class="position-absolute top-0 end-0 text-muted">Login</a>
	<form action="confirmation.php" method="post">
		<h1 class="text-center">Pc Part Store Thingy</h1>
		<h2>Logged in as <?= $account["username"]; ?></h2>
		<a href="profile.php">PROFILE</a>
		<a href="login.php?logout">LOGOUT</a>
		<h2>Cpu</h2>
		<div class="card-group">
			<?php 
				foreach (getArr("cpu") as $cpu) {
					$id = $cpu["id"];
					$name = $cpu["name"];
					$core = $cpu["core"];
					$speed = $cpu["speed"];
					$price = $cpu["price"];
					$image = $cpu["image"];

					print("
						<div class='card'>
							<img class='card-img-top' src='img/$image' alt='$name' >
							<div class='card-body'>
								<h5 class='card-title'>$name</h5>
								<h6 class='card-subtitle'>&euro;$price</h6>
								<ul class='list-group list-group-flush'>
									<li class='list-group-item'>Clock speed: $speed</li>
									<li class='list-group-item'>Core count: $core</li>
								</ul>
								<input type='radio' class='btn-check' id='cpu$id' name='cpu' value='$id' autocomplete='off' required>
								<label class='btn btn-outline-primary' for='cpu$id'>Order</label><br>
							</div>
						</div>
					");
				}
			?>
		</div>
		<h2>Ram</h2>
		<div class="card-group">
			<?php 
				foreach (getArr("ram") as $ram) {
					$id = $ram["id"];
					$name = $ram["name"];
					$size = $ram["size"];
					$type = $ram["type"];
					$speed = $ram["speed"];
					$price = $ram["price"];
					$image = $ram["image"];

					print("
						<div class='card'>
							<img class='card-img-top' src='img/$image' alt='$name' >
							<div class='card-body'>
								<h5 class='card-title'>$name</h5>
								<h6 class='card-subtitle'>&euro;$price</h6>
								<ul class='list-group list-group-flush'>
									<li class='list-group-item'>Size: $size</li>
									<li class='list-group-item'>Type: $type</li>
									<li class='list-group-item'>Speed: $speed</li>
								</ul>
								<input type='radio' class='btn-check' id='ram$id' name='ram' value='$id' autocomplete='off' required>
								<label class='btn btn-outline-primary' for='ram$id'>Order</label><br>
							</div>
						</div>
					");
				}
			?>
		</div>
		<h2>Gpu</h2>
		<div class="card-group">
			<?php 
				foreach (getArr("gpu") as $gpu) {
					$id = $gpu["id"];
					$name = $gpu["name"];
					$boost = $gpu["boost"];
					$memory = $gpu["memory"];
					$price = $gpu["price"];
					$image = $gpu["image"];

					print("
						<div class='card'>
							<img class='card-img-top' src='img/$image' alt='$name' >
							<div class='card-body'>
								<h5 class='card-title'>$name</h5>
								<h6 class='card-subtitle'>&euro;$price</h6>
								<ul class='list-group list-group-flush'>
									<li class='list-group-item'>Memory: $memory</li>
									<li class='list-group-item'>Boost speed: $boost</li>
								</ul>
								<input type='radio' class='btn-check' id='gpu$id' name='gpu' value='$id' autocomplete='off' required>
								<label class='btn btn-outline-primary' for='gpu$id'>Order</label><br>
							</div>
						</div>
					");
				}
			?>
		</div>
		<h2>Case</h2>
		<div class="card-group">
			<?php 
				foreach (getArr("box") as $box) {
					$id = $box["id"];
					$name = $box["name"];
					$price = $box["price"];
					$image = $box["image"];

					print("
						<div class='card'>
							<img class='card-img-top' src='img/$image' alt='$name' >
							<div class='card-body'>
								<h5 class='card-title'>$name</h5>
								<h6 class='card-subtitle'>&euro;$price</h6>
								<input type='radio' class='btn-check' id='box$id' name='box' value='$id' autocomplete='off' required>
								<label class='btn btn-outline-primary' for='box$id'>Order</label><br>
							</div>
						</div>
					");
				}
			?>
		</div>
		<input class="btn btn-primary" type="submit" value="Order">
	</form>
</body>
</html>
