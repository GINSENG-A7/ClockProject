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
	if (isset($_POST['valueSize']) &&
		isset($_POST['sectionIdSize'])) {
		$value = $_POST['valueSize'];
		$section_id = $_POST['sectionIdSize'];

		AddNewSize($conn, $value, true, $section_id);
		?>
		<script>
			alert("Данные успешно добавлены");
		</script>
		<?
	}
	else {
		throw new Exception('POST data is not set.');
	}
?>