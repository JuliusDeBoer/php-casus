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
	<?php
		require_once("../src/account.php");

		$cpu = $_POST["cpu"];
		$gpu = $_POST["gpu"];
		$ram = $_POST["ram"];
		$box = $_POST["box"];
		$date = date('o-m-d');

		$sql = "SELECT SUM(price) as price
			FROM (
				SELECT price FROM cpu WHERE id = $cpu
				UNION ALL
				SELECT price FROM gpu WHERE id = $gpu
				UNION ALL
				SELECT price FROM gpu WHERE id = $ram
				UNION ALL
				SELECT price FROM box WHERE id = $box
			) as parts;";		

		$result = Db::query($sql);
		$price = $result->fetch()["price"];

		$customerId = getAccount()['id'];
		
		Db::query("INSERT INTO `orders` (`customerId`, `total`, `date`) VALUES ('$customerId', '$price', '$date');");

		$orderId = Db::query("SELECT LAST_INSERT_ID() as id;")->fetch(PDO::FETCH_ASSOC)["id"];

		// Haha bad code go brrrrr
		Db::query("INSERT INTO `orderDetails` (`orderId`, `type`, `productId`) VALUES ($orderId, 'cpu', $cpu);");
		Db::query("INSERT INTO `orderDetails` (`orderId`, `type`, `productId`) VALUES ($orderId, 'gpu', $gpu);");
		Db::query("INSERT INTO `orderDetails` (`orderId`, `type`, `productId`) VALUES ($orderId, 'ram', $ram);");
		Db::query("INSERT INTO `orderDetails` (`orderId`, `type`, `productId`) VALUES ($orderId, 'box', $box);");
	?>

	<div class="position-absolute top-50 start-50 translate-middle border border-success bg-success-subtle rounded text-center p-5">
		<h1>&check;</h1>
		<h2>Order confirmed!</h2>
		<h3>Yeey!</h3>
		<button type="button" class="btn btn-success" onclick="window.location = '/'">Back</button>
	</div>
</body>
</html>
