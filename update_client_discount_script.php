<?require_once("./connection_script.php")?>
<?require_once("./classes/entryClass.php")?>
<?session_start()?>
<?
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];
		// print_r($login);
	} 
	else {
		$login = NULL;
	}
	if (isset($_POST["idUser"]) && isset($_POST["clientDiscount"])) {
		$idUser = $_POST["idUser"];
		$newDiscount = $_POST["clientDiscount"] / 100;
		UpdateUsersDiscount($clockUsersConn, $newDiscount, $idUser);
	}
?>