<?require_once("./connection_script.php");?>
<?require_once("./classes//userClass.php");?>
<?session_start()?>
<?
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];
		$managerArray = SelectUserByLogin($clockUsersConn, $login);
		$manager = new User(
			$managerArray['idUser'], 
			$managerArray['idRole'], 
			$managerArray['login'], 
			$managerArray['password']
		);
		// print_r($login);
	}
	else {
		$login = NULL;
	}
	if (isset($_POST['idTicket'])) {
		$idTicket = $_POST['idTicket'];
		if (isset($_POST['idUser'])) {
			$idUser = $_POST['idUser'];
			print_r("1");
			UpdateTicketStatusAndPerformer($clockUsersConn, $manager->idUser, "false", $idTicket);
		}
		print_r("2");
		UpdateSimpleTicketStatusAndPerformer($clockUsersConn, $manager->idUser, "false", $idTicket);
	}
?>