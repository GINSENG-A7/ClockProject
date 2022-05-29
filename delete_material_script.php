<?include "./connection_script.php"?>
<?php
	session_start();
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];
	} 
	else {
		$login = NULL;
	}
	if (isset($_POST['idMaterial'])) {
		$idMaterial = $_POST['sectionIdSize'];

		DeleteMaterialById($conn, $idMaterial);
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