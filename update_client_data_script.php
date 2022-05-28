<?include "./connection_script.php"?>
<?require_once ("./classes/advancedUserClass.php");?>
<?php
	session_start();
	if (isset($_POST['idUser']) &&
	isset($_POST['clientLogin']) &&
	isset($_POST['clientEmail']) &&
	isset($_POST['clientRole']) && 
	isset($_POST['clientName']) &&
	isset($_POST['clientSurname']) &&
	isset($_POST['clientPatronymic']) &&
	isset($_POST['clientDiscount'])) {
		if (isset($_SESSION["login"])) {
			$login = $_SESSION["login"];
		} 
		else {
			$login = NULL;
		}
		$idUser = $_POST['idUser'];
		$clientLogin = $_POST['clientLogin'];
		$roleId = $_POST['clientRole'];
		$name = $_POST['clientName'];
		$surname = $_POST['clientSurname'];
		$patronymic = $_POST['clientPatronymic'];
		$email = $_POST['clientEmail'];
		$discount = $_POST['clientDiscount'];

		$userArray = SelectUserByUserId($clockUsersConn, $idUser);
		print_r($name);
		print_r($surname);
		print_r($patronymic);
		print_r($email);
		print_r($discount);

		$user = new AdvancedUser(
			$idUser,
			$roleId,
			$clientLogin,
			$userArray->password,
			$name,
			$surname,
			$patronymic,
			$userArray->district,
			$userArray->city,
			$userArray->street,
			$userArray->house,
			$userArray->flat,
			$userArray->postIndex,
			$email,
			null,
			$discount / 100
		);
		UpdateUsersDataAsAdmin(
			$clockUsersConn, 
			$user->idUser,
			$user->login, 
			$user->name,
			$user->surname,
			$user->patronymic,
			$user->district,
			$user->city,
			$suer->street,
			$user->house,
			$user->flat,
			$user->postIndex,
			$user->discount,
			$user->idRole
		);
		?>
		<script>
			alert("Данные успешно обновлены");
		</script>
		<?
	}
	else {
		throw new Exception('POST data is not set.');
	}
?>