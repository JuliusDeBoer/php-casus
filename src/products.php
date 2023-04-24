<?php
require_once("db.php");

function getArr(string $name) {
	return Db::query("SELECT * FROM $name")->fetchAll(PDO::FETCH_ASSOC);
}
?>
