<?include "./connection_script.php"?>
<?php
	if (isset($_POST['Login']) && 
	isset($_POST['Password']) && 
	isset($_POST['Name']) &&
	isset($_POST['Surname']) &&
	isset($_POST['Patronymic']) && 
	isset($_POST['Address']) && 
	isset($_POST['Email'])) {
		$login = $_POST['Login'];
		$password = $_POST['Password'];
		$name = $_POST['Name'];
		$surname = $_POST['Surname'];
		$patronymic = $_POST['Patronymic'];
		$address = $_POST['Address'];
		$email = $_POST['Email'];
		AddNewUserInDatabase($clockUsersConn, $login, $password, $name, $surname, $patronymic, $address, $email);
		header('index.php');
	}
	else {
		throw new Exception('POST data is not set.');
	}
?>