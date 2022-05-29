<?include "./connection_script.php"?>
<?php
	session_start();
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];
	} 
	else {
		$login = NULL;
	}
	if (isset($_POST['valueMaterial'])) {
		$value = $_POST['valueMaterial'];

		AddNewMaterial($conn, $value);
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