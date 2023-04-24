<?php
	require_once("../src/account.php");
	require_once("../src/db.php");
	if(!isLoggedIn()) {
		header('Location: login.php');
		exit();
	}

	$account = getAccount();
	$customerId = $account["id"]
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
	<h1>Profile of <?= $account["username"] ?></h1>
	<a href="login.php?logout">LOGOUT</a>
	<?php
		if(isAdmin()) {
			print("<br><a href='admin.php'>ADMIN</a>");
			print("<br><a href='users.php'>USERS</a>");
		}
	?>
	<?php
		foreach (getArr("orders WHERE `customerId` = '$customerId';") as $order) {
			$orderId = $order["id"];
			$total = $order["total"];
			print("<div class='card-group'>");
			foreach(getArr("orderDetails WHERE orderId = '$orderId';") as $detail) {
				$type = $detail["type"];
				$productId = $detail["productId"];
				$info = Db::query("SELECT * FROM `$type` WHERE id = '$productId';")->fetch(PDO::FETCH_ASSOC);

				$name = $info["name"];
				$image = $info["image"];
				$price = $info["price"];

				print("
					<div class='card'>
						<img class='card-img-top' src='img/$image' alt='$name' >
						<div class='card-body'>
							<h5 class='card-title'>$name</h5>
							<h6 class='card-subtitle'>&euro;$price</h6>
						</div>
					</div>
				");
			}
			print("</div>");
			print("<h2>Total: &euro;$total</h2><hr>");
		}
	?>

	<div class="d-grid gap-2 col-6 mx-auto">
		<button class="btn btn-primary" type="button" onclick="window.location = '/'">Back</button>
	</div>
</body>
</html>
