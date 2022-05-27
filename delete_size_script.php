<?include "./connection_script.php"?>
<?require_once ("./classes/advancedUserClass.php");?>
<?php
	session_start();
	if (isset($_POST['idUser'])) {
		if (isset($_SESSION["login"])) {
			$login = $_SESSION["login"];
		} 
		else {
			$login = NULL;
		}
		$idUser = $_POST['idUser'];

		DeleteUserCascade($clockUsersConn, $conn, $idUser)
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