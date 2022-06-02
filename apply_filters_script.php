<?include "./connection_script.php"?>
<?require_once ("./classes/advancedUserClass.php");?>
<?php
	session_start();
	if (isset($_GET['min-price']) &&
	isset($_GET['max-price']) &&
	isset($_GET['section']) &&
	isset($_GET['material'])) {
		if (isset($_SESSION["login"])) {
			$login = $_SESSION["login"];
		} 
		else {
			$login = NULL;
		}
		$minPrice = $_GET['min-price'];
		$maxPrice = $_GET['max-price'];
		$sectionId = $_GET['section'];
		$materialId = $_GET['material'];

		// print_r($minPrice);
		// print_r($maxPrice);
		// print_r($sectionId);
		// print_r($materialId);

		header("Location: ./shop.php?min-price=0&max-price=9999999&section=3&material%5B%5D=on&material%5B%5D=on&material%5B%5D=on");
	}
	else {
		throw new Exception('POST data is not set.');
	}
?>