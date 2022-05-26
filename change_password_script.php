<?include "./connection_script.php"?>
<?require_once ("./classes/advancedUserClass.php");?>
<?php
	session_start();
	if (isset($_POST['OldPassword']) && 
	isset($_POST['NewPassword']) && 
	isset($_POST['NewPasswordAgain'])) {
		if (isset($_SESSION["login"])) {
			$login = $_SESSION["login"];
			print_r($login);
		} 
		else {
			$login = NULL;
		}
		$oldPassword = $_POST['OldPassword'];
		$newPassword = $_POST['NewPassword'];
		$newPasswordAgain = $_POST['NewPasswordAgain'];

		$userArray = SelectUserByLogin($conn, $login);
		if($oldPassword == $userArray['password']) {
			UpdateUsersPassword(
				$clockUsersConn, 
				$login,
				$newPassword,
			);
		}
		else {
			setcookie("password_response", false);
		}
	}
	else {
		throw new Exception('POST data is not set.');
	}
?>