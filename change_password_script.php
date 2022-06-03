<?

use PHPMailer\PHPMailer\PHPMailer;

require_once("./connection_script.php");?>
<?require "./phpmailer/src/Exception.php";?>
<?require "./phpmailer/src/PHPMailer.php";?>
<?require_once ("./classes/advancedUserClass.php");?>
<?php
	session_start();
	if (isset($_POST['OldPassword']) && 
	isset($_POST['NewPassword']) && 
	isset($_POST['NewPasswordAgain'])) {
		if (isset($_SESSION["login"])) {
			$login = $_SESSION["login"];
		} 
		else {
			$login = NULL;
		}
		$oldPassword = $_POST['OldPassword'];
		$newPassword = $_POST['NewPassword'];
		$newPasswordAgain = $_POST['NewPasswordAgain'];
		$_SESSION['newPassword'] = $newPassword;
		
		$userArray = SelectUserByLogin($clockUsersConn, $login);
		if (md5($oldPassword) == $userArray['password']) {
			// UpdateUsersPassword(
				// 	$clockUsersConn, 
				// 	$login,
				// 	$newPassword,
				// );
				
			$recovery = SelectRecoveryByUserId($clockUsersConn, $userArray['idUser']);
			if ($recovery != NULL) {
				DeleteRecoveryByUser($clockUsersConn, $userArray['idUser']);
			}
			$hash = strval(md5(time()));
			$code = mb_substr($hash, strlen($hash) - 6, strlen($hash));
			SendMail($userArray, $code);
			$date = date('Y-m-d H:i:s', time());
			AddNewRecoveryToUser($clockUsersConn, $code, $date, $userArray['idUser']);
			header("Location: /recoveryPassword.php");
		}
		else {
			setcookie("password_response", false);
		}
	}
	elseif (isset($_POST['Code'])) {
		if (isset($_SESSION["login"])) {
			$login = $_SESSION["login"];
		} 
		else {
			$login = NULL;
		}
		$userArray = SelectUserByLogin($clockUsersConn, $login);
		$code = $_POST['Code'];
		$recovery = SelectRecoveryByUserId($clockUsersConn, $userArray['idUser']);
		print_r($_SESSION['newPassword']);
		if ($code = $recovery['hash']) {
			UpdateUsersPassword(
				$clockUsersConn, 
				$login,
				$_SESSION['newPassword'],
			);
			unset($_SESSION['newPassword']);
		}
	}
	else {
		throw new Exception('POST data is not set.');
	}

	function SendMail($userArray, $code) {
		$mail = new PHPMailer(true);
		$mail->CharSet = 'UTF-8';
		$mail->setLanguage('ru', 'phpmailer/language');
		$mail->IsHTML(true);

		$mail->setFrom('genshen21@gmail.com', 'Интернет магазин ювелирных украшений "K.Max Jeveler"');
		$mail->addAddress($userArray['email']);
		$mail->Subject = 'Отслеживание заказа.';

		$body = "<h2>".$userArray['name']." ".$userArray['patronymic'].", никому не сообщайте нижеуказанный код.</h2>";
		$body .= "<br>";
		$body .= "<h3>Ваш код восстановления пароля: ".$code.".</h3>";
		$body .= "<br>";
		$body .= "<h4>Данное письмо сгенерированно автоматически. Пожалуйста, не отвечайте на него.</h4>";

		$mail->Body = $body;

		if (!$mail->send()) {
			$message = 'Ошибка отправки письма';
		}
		else {
			$message = 'Данные отправлены!';
		}
		// print_r($message);
	}
?>