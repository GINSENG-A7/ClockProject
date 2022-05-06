<?require_once ("./connection_script.php")?>
<?require_once ('./classes/userClass.php')?>
<?require_once ('./classes/advancedUserClass.php')?>
<?php
	session_start();
	if (isset($_POST['Login']) && 
	isset($_POST['Password'])) {
		$login = $_POST['Login'];
		$password = $_POST['Password'];;
		$response = CheckUserAuthorizationData($clockUsersConn, $login, $password);
		if ($response == true) {
			$resultArray = SelectUserByLogin($clockUsersConn, $login);
			$role = SelectRoleById($clockUsersConn, $resultArray['idRole'])['role'];
			if ($role != "user") {
				// $user = new User(
				// 	$resultArray['idUser'],
				// 	$resultArray['idRole'],
				// 	$resultArray['login'],
				// 	$resultArray['password']
				// );
				$_SESSION["login"] = $resultArray['login'];
				if ($role == "admin") {
					?>
					<script>
						window.location.replace("/admin.php");
					</script>
					<?
				}
				else {
					$_SESSION["login"] = $resultArray['login'];
					//редирект на страницу менеджера
				}
			}
			else {
				// $user = new AdvancedUser(
				// 	$resultArray['idUser'],
				// 	$resultArray['idRole'],
				// 	$resultArray['login'],
				// 	$resultArray['password'],
				// 	$resultArray['name'],
				// 	$resultArray['surname'],
				// 	$resultArray['patronymic'],
				// 	$resultArray['address'],
				// 	$resultArray['email'],
				// 	$resultArray['token'],
				// 	$resultArray['discount']
				// );
				$_SESSION["login"] = $resultArray['login'];
				$login = $_SESSION["login"];
				print_r($_SESSION["login"]);
				?>
				<script>
					window.location.replace("/index.php");
				</script>
				<?
			}
		}
		else {
			session_destroy();
			setcookie("authorize_response", "false");
			print("false\n\r");
			?>
			<script>
				window.location.replace("/userSingUpOrLogin.php");
			</script>
			<?
		}
	}
	else {
		throw new Exception('POST data is not set.');
	}
?>