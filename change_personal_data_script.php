<?include "./connection_script.php"?>
<?require_once ("./classes/advancedUserClass.php");?>
<?php
	session_start();
	if (isset($_POST['Name']) &&
	isset($_POST['Surname']) &&
	isset($_POST['Patronymic']) && 
	isset($_POST['District']) &&
	isset($_POST['City']) &&
	isset($_POST['Street']) &&
	isset($_POST['House']) &&
	isset($_POST['Flat']) &&
	isset($_POST['PostIndex']) &&
	isset($_POST['Email'])) {
		if (isset($_SESSION["login"])) {
			$login = $_SESSION["login"];
			print_r($login);
		} 
		else {
			$login = NULL;
		}
		$password = $_POST['Password'];
		$name = $_POST['Name'];
		$surname = $_POST['Surname'];
		$patronymic = $_POST['Patronymic'];
		$address = $_POST['Address'];
		$district = $_POST['District'];
		$city = $_POST['City'];
		$street = $_POST['Street'];
		$house = $_POST['House'];
		$flat = $_POST['Flat'];
		$postIndex = $_POST['PostIndex'];
		$email = $_POST['Email'];

		$user = new AdvancedUser(
			0,
			3,
			$login,
			$password,
			$name,
			$surname,
			$patronymic,
			$district,
			$city,
			$street,
			$house,
			$flat,
			$postIndex,
			$email,
			null,
			0
		);
		//Изменить добавление на новый формат адреса
		UpdateUsersData(
			$clockUsersConn, 
			$user->login, 
			$user->name,
			$user->surname,
			$user->patronymic,
			$user->district,
			$user->city,
			$suer->street,
			$user->house,
			$user->flat,
			$user->postIndex
		);
	}
	else {
		throw new Exception('POST data is not set.');
	}
?>