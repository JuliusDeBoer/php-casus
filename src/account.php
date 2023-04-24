<?php
require_once("db.php");
require_once("jwt.php");

function isLoggedIn(): bool {
	if(!isset($_COOKIE["login"])) {
		return false;
	}

	$jwt = new Jwt();
	$jwt->import($_COOKIE["login"]);
	return $jwt->valid();
}

function isAdmin(): bool {
	if(!isLoggedIn()) {
		return false;
	}

	return getAccount()["admin"] === 1;
}

function login(string $username, string $password): bool {
	$result = Db::query("SELECT * FROM users WHERE username = '$username';")->fetch(PDO::FETCH_ASSOC);
	$success = password_verify($password, $result["password"]);

	if($success) {
		$jwt = new Jwt();
		$jwt->payload = [
			"usr" => $username,
		];
		$jwt->saveToCookie("login");
	}

	return $success;
}

function signUp(string $username, string $password, string $address) {
	$encrypted = password_hash($password, PASSWORD_DEFAULT);
	Db::query("INSERT INTO `users` (`username`, `password`, `address`, `admin`) VALUES ('$username', '$encrypted', '$address', 0);");
}

function logout() {
	setcookie("login", "");
}

function getAccount() {
	if(!isLoggedIn()) {
		return false;
	}

	$jwt = new Jwt();
	$jwt->import($_COOKIE["login"]);
	$username = $jwt->payload["usr"];

	return Db::query("SELECT * FROM `users` WHERE `username` = '$username';")->fetch(PDO::FETCH_ASSOC);
}
?>
