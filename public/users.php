<?php
	require_once("../src/account.php");
	require_once("../src/db.php");

	if(!isLoggedIn()) {
		header('Location: login.php');
		exit();
	}
?>
<?php
require_once("../src/account.php");

if(isset($_GET["toggle"])) {
	$currentUser = getAccount();
	$id = $_GET["toggle"];

	if($currentUser["id"] == $id || !isAdmin()) {
		header("Location: users.php");
		exit();
	}

	$target = Db::query("SELECT * FROM users WHERE id = '$id';")->fetch(PDO::FETCH_ASSOC);
	$admin = $target["admin"] === 1 ? "0" : "1";
	Db::query("UPDATE `users` SET `admin` = '$admin' WHERE `users`.`id` = $id ");

	header("Location: users.php");
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
	<?php require_once("../src/products.php"); ?>
</head>
<body>
	<table>
		<?php
			foreach (getArr("users") as $user) {
				$id = $user["id"];
				$username = $user["username"];
				$address = $user["address"];
				$admin = $user["admin"] === 1 ? "Yes" : "No";

				print("<tr>");
				print("<td>$username</td>");
				print("<td>$address</td>");
				print("<td class='clickable' onclick='window.location.href = \"?toggle=$id\"'>Admin: $admin</td>");
				print("</tr>");
			}
		?>
	</table>
	<hr>
	<div class="d-grid gap-2 col-6 mx-auto">
		<button class="btn btn-primary" type="button" onclick="window.location = 'profile.php'">Back</button>
	</div>
</body>
</html>
