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

		$headerString = "./shop.php?min-price=".$minPrice."&max-price=".$maxPrice."&section=".$sectionId."";
		for ($i = 0; $i < count($materialId); $i++) { 
			$headerString .= "&material%5B%5D=".$materialId[$i]."";
		}

		header("Location: ./shop.php?min-price=".$minPrice."&max-price=".$maxPrice."&section=".$sectionId."&material%5B%5D=on&material%5B%5D=on&material%5B%5D=on");
	}
	else {
		throw new Exception('POST data is not set.');
	}
?>