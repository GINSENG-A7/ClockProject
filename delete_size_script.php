<?include "./connection_script.php"?>
<?require_once ("./classes/advancedUserClass.php");?>
<?php
	session_start();
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];
	} 
	else {
		$login = NULL;
	}
	if (isset($_POST['sizeId'])) {

		$idSize = $_POST['sizeId'];
		DeleteSizeById($conn, $idSize);
		?>
		<script>
			alert("Данные успешно удалены");
		</script>
		<?
	}
	else {
		throw new Exception('POST data is not set.');
	}
?>