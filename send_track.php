<?

use PHPMailer\PHPMailer\PHPMailer;

require_once("./connection_script.php");?>
<?require "./phpmailer/src/Exception.php";?>
<?require "./phpmailer/src/PHPMailer.php";?>
<?require_once ("./classes/advancedUserClass.php");?>
<?
session_start();
if (isset($_SESSION["login"])) {
	$login = $_SESSION["login"];
	// print_r($login);
} 
else {
	$login = NULL;
}
if (isset($_POST["idUser"]) && 
isset($_POST["idOrder"]) &&
isset($_POST["track"])) {
	$user = SelectUserByUserId($clockUsersConn, $_POST["idUser"]);
	$track = $_POST['track'];
	//Отправка оповещения на почту
	SendMail($user, $track);
	
	// $paidDateAsStr = $_POST["paidDate"];
	// $paidDateFormated = date('Y-m-d H:i:s', strtotime($paidDateAsStr));
	// print($paidDateFormated);
	
	UpdateTrackAndStatusInOrderById($clockUsersConn, $track, 5, $_POST["idOrder"]);
}

function SendMail($user, $track) {
	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language');
	$mail->IsHTML(true);

	$mail->setFrom('genshen21@gmail.com', 'Интернет магазин ювелирных украшений "K.Max Jeveler"');
	$mail->addAddress($user->email);
	$mail->Subject = 'Отслеживание заказа.';

	$body = "<h2>".$user->name." ".$user->patronymic.", мы передали ваш заказ службе доставки.</h2>";
	$body .= "<br>";
	$body .= "<h3>Ваш трек номер: ".$track.".</h3>";
	$body .= "<br>";
	$body .= "<h4>Данное письмо сгенерированно автоматически. Пожалуйста, не отвечайте на него.</h4>";

	$mail->Body = $body;

	if (!$mail->send()) {
		$message = 'Ошибка отправки письма';
	}
	else {
		$message = 'Данные отправлены!';
	}
	print_r($message);
}
?>