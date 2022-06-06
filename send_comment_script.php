<?require_once("./connection_script.php");?>
<?require_once ("./classes/advancedUserClass.php");?>
<?php
	session_start();
	if (isset($_POST['idEntry']) &&
	isset($_POST['comment']) && 
	isset($_POST['simple-rating'])) {
		if (isset($_SESSION["login"])) {
			$login = $_SESSION["login"];
			// print_r($login);
		} 
		else {
			$login = NULL;
		}
		$comment = $_POST['comment'];
		$rating = intval($_POST['simple-rating']);
		$idEntry = $_POST['idEntry'];
		
		$userArray = SelectUserByLogin($clockUsersConn, $login);
		$usersComments = SelectCommentByEntryIdAndUserId($conn, $idEntry, $userArray['idUser']);
		if ($usersComments == NULL) {
			//Добавить комент date('Y-m-d H:i:s', strtotime($paidDateAsStr))
			AddNewComment($conn, $comment, $rating, date('Y-m-d H:i:s', time()), $idEntry, $userArray['idUser']);
			// header("Location: ./descripshen?id=".$idEntry."");
			header("Refresh:0; url=./descripshen?id=".$idEntry."");
		}
	}
	else {
		throw new Exception('POST data is not set.');
	}
?>