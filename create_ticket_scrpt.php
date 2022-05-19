<?

use PHPMailer\PHPMailer\PHPMailer;

require_once("./connection_script.php");?>
<?require "./phpmailer/src/Exception.php";?>
<?require "./phpmailer/src/PHPMailer.php";?>
<?session_start()?>
<?
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];
		// print_r($login);
	}
	else {
		$login = NULL;
	}
	if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['theme']) && isset($_POST['message'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$telephone = $_POST['telephone'];
		$theme = $_POST['theme'];
		$body = $_POST['message'];
		AddNewSimpleTicket($clockUsersConn, $theme, $body, true, $name, $email, $telephone, date('Y-m-d H:i:s'));
	}
	elseif (isset($_POST['theme']) && isset($_POST['message'])) {
		$theme = $_POST['theme'];
		$body = $_POST['message'];
		$user = SelectUserByLogin($clockUsersConn, $login);
		SendMail($user['email']);
		print_r($user['email']);
		AddNewTicket($clockUsersConn, $theme, $body, true, date('Y-m-d H:i:s'), $login, 'NULL');
	}


function SendMail($user_email) {
	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language');
	$mail->IsHTML(true);

	$mail->setFrom('genshen21@gmail.com', 'Интернет магазин ювелирных украшений "K.Max Jeveler"');
	$mail->addAddress($user_email);
	$mail->Subject = 'Администрация сайта получила ваше сообщение.';

	$body = "<h2>Мы получили ваше письмо и уже работаем над вашим вопросом.</h2>";
	$body .= "<br>";
	$body .= "<h3>Вскоре с вами свяжется наш менеджер для дальнейшего разрешения вашего вопроса.</h3>";
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