<?require_once ("./connection_script.php");?>
<?php
	session_start();
	if (isset($_POST['idComment']) && 
	isset($_POST['idEntry'])) {
		if (isset($_SESSION["login"])) {
			$login = $_SESSION["login"];
			// print_r($login);
		} 
		else {
			$login = NULL;
		}
		$idComment = $_POST['idComment'];
		$idEntry = $_POST['idEntry'];
		$userArray = SelectUserByLogin($clockUsersConn, $login);
		$commentArray = SelectCommentByCommentId($conn, $idComment);
		// print_r($userArray);
		// print_r($commentArray['entry_id']);
		if ($userArray['idUser'] == $commentArray['user_id'] || $userArray['idRole'] == 1 || $userArray['idRole'] == 2) {
			DeleteCommentById($conn, $idComment);
			header("Location: ./descripshen.php?id=".$idEntry."");
		}
	}
	else {
		throw new Exception('POST data is not set.');
	}
?>