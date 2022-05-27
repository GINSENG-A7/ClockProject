<?include "./connection_script.php"?>
<?require_once ("./classes/advancedUserClass.php");?>
<?php
	session_start();
	if (isset($_POST['sizeId'])) {
		if (isset($_SESSION["login"])) {
			$login = $_SESSION["login"];
		} 
		else {
			$login = NULL;
		}
		$idSize = $_POST['sizeId'];
		$sizeArray = SelectSizeById($conn, $idSize);
		if($sizeArray['idSize'] == true) {
			UpdateSizeIsActiveById($conn, "false", $idSize);
		}
		else {
			UpdateSizeIsActiveById($conn, "true", $idSize);
		}
		?>
		<script>
			alert("Данные успешно изменены");
		</script>
		<?
	}
	else {
		throw new Exception('POST data is not set.');
	}
?>