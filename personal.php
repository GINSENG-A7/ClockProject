<?include "./connection_script.php"?>
<?require_once("./classes/advancedUserClass.php");?>
<?session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/personal.css" rel="stylesheet">
    <link rel="shortcut icon" href="./img/logo.webp" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>K.Max.Jeweller</title>
</head>
<body>
	<?
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];
		// print_r($login);\
		$userArray = SelectUserByLogin($clockUsersConn, $login);
		$user = new AdvancedUser(
			$userArray["idUser"],
			$userArray["idRole"],
			$userArray["login"],
			$userArray["password"],
			$userArray["name"],
			$userArray["surname"],
			$userArray["patronymic"],
			$userArray["district"],
			$userArray["city"],
			$userArray["street"],
			$userArray["house"],
			$userArray["flat"],
			$userArray["post_index"],
			$userArray["email"],
			$userArray["token"],
			$userArray["discount"]
		);
	} 
	else {
		$login = NULL;
	}
	?>    
	<div class="headerWrapper">
		<header class="header">
			<div class="header__logo">
				<a href='./index.php' class="header__logo-linkWrapper">
					<img src="./img/logo.webp" alt="logo">
				</a>
				<div class="header__logo-textWrapper">
					<span>K.Max.Jeweller</span>
					<div class="header__logo-textWrapper-phonesWrapper">
						<a class="header__logo-phone phone" href="tel:8-905-534-09-56">8-905-534-09-56</a>
						<a class="header__logo-phone phone" href="tel:8-499-190-09-56">8-499-190-09-56</a>
					</div>
				</div>
			</div>
			<div class="header__menu">
				<div class="header__menu-icon">
					<span></span>
				</div>
				<nav class="header__menu-body">
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link" href="./shop.php?id=1">????????</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="./shop.php?id=2">??????????????????</a>
							<span class="nav-arrow"></span>
							<ul class="nav-sub">
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=2">????????????????</a></li>
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=3">????????????</a></li>
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=4">????????????????</a></li>
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=5">????????</a></li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="./shop.php?id=6">????????????????????</a>
							<span class="nav-arrow"></span>
							<ul class="nav-sub">
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=6">??????????</a></li>
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=7">????????????</a></li>
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=8">????????????????</a></li>
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=9">????????????</a></li>
							</ul>
						</li>
						<!-- <li class="nav-item"><a class="nav-link" href="./contacts.php">????????????????</a></li> -->
						<li class="nav-item">
							<a class="nav-link" <?if ($login == NULL) {echo('href="./userSingUpOrLogIn.php"');}?>>
								<i class="fa fa-user" style="font-size:24px"></i>
							</a>
							<?
							if ($login != NULL) {
								?>
								<span class="nav-arrow"></span>
								<ul class="nav-sub">
									<li class="nav-sub__item"><a class="nav-sub__link" href="/cart.php">??????????????</a></li>
									<li class="nav-sub__item"><a class="nav-sub__link" href="/recentOrders.php">????????????</a></li>
									<li class="nav-sub__item"><a class="nav-sub__link" href="/personal.php">???????????? ??????????????</a></li>
									<li class="nav-sub__item"><a class="nav-sub__link" href="/emailForm.php">?????????????????? ?? ????????????????????</a></li>
									<li class="nav-sub__item">
										<form id="exit_form" action="/exit_script.php" method="post" style="display: none;">
											<input id="exit_input" type="submit" name="exit_input" style="display: none;">
										</form>
										<a id="exit_link" class="nav-sub__link" href="">??????????</a>
									</li>
								</ul>
								<?
							}
							?>
						</li>
						<li class="nav-item disappearable">
							<div class="nav-item-textWrapper">
								<span class = "contact-person">K.Max.Jeweller</span>
								<a class="contact-phone phone" href="tel:8-905-534-09-56">8-905-534-09-56</a>
								<a class="contact-phone phone" href="tel:8-499-190-09-56">8-499-190-09-56</a>
							</div>
						</li>
					</ul>
				</nav>
			</div>
		</header>
		<hr>
	</div>
	<h2>???????????? ??????????????</h2>
	<div class="wrapper">
		<div class="personal">
			<form class="personal__data-form" action="./change_personal_data_script.php">
				<div class="wrapper-inputs">
					<div class="wrapper-inputs__login">
						<p>??????????: </p>
						<input class="input" id="Login" name="Login" type="text" value="<?=$user->login?>" readonly>
					</div>
					<div class="wrapper-inputs__name">
						<p>??????: </p>
						<input class="input" id="Name" name="Name" type="text" value="<?=$user->name?>">
					</div>
					<div class="wrapper-inputs__surname">
						<p>??????????????: </p>
						<input class="input" id="Surname" name="Surname" type="text" value="<?=$user->surname?>">
					</div>
					<div class="wrapper-inputs__patronymic">
						<p>????????????????: </p>
						<input class="input" id="Patronymic" name="Patronymic" type="text" value="<?=$user->patronymic?>">
					</div>
					<div class="wrapper-inputs__email">
						<p>????. ??????????: </p>
						<input class="input" id="Email" name="Email" type="text" value="<?=$user->email?>" readonly>
					</div>
					<div class="wrapper-inputs__discount">
						<p>???????? ????????????: </p>
						<div style="display: block; text-align: left; margin-top: 17px;"><?=$user->discount * 100?> %</div>
					</div>
					<div class="wrapper-inputs__address">
						<p class="section_title">??????????</p>
						<div class="district">
							<p>??????????????: </p>
							<input class="input" id="District" name="District" type="text" value="<?=$user->district?>">
						</div>
						<div class="city">
							<p>??????????: </p>
							<input class="input" id="City" name="City" type="text" value="<?=$user->city?>">
						</div>
						<div class="street">
							<p>??????????: </p>
							<input class="input" id="Street" name="Street" type="text" value="<?=$user->street?>">
						</div>
						<div class="house">
							<p>??????: </p>
							<input class="input" id="House" name="House" type="text" value="<?=$user->house?>">
						</div>
						<div class="flat">
							<p>????????????????: </p>
							<input class="input" id="Flat" name="Flat" type="text" value="<?=$user->flat?>">
						</div>
						<div class="postIndex">
							<p>???????????????? ????????????: </p>
							<input class="input" id="PostIndex" name="PostIndex" type="text" value="<?=$user->postIndex?>">
						</div>
					</div>

					<input class="input" id="ChangeData" type="submit"style="display: none;">
				</div>
				<button id="changeDataButton" class="button">???????????????? ????????????</button>
			</form>
			<form class="personal__password-form" action="./change_password_script.php" method="POST">
				<div class="wrapper-inputs">
					<div class="wrapper-inputs__passwordChange">
						<p class="section_title">?????????? ????????????</p>
						<div class="oldPassword">
							<p>???????????? ????????????: </p>	
							<input class="input" id="OldPassword" name="OldPassword" type="password">
						</div>
						<div class="newPassword">
							<p>?????????? ????????????: </p>	
							<input class="input" id="NewPassword" name="NewPassword" type="password">
						</div>
						<div class="newPasswordAgain">
							<p>?????????????????????? ????????????: </p>
							<input class="input" id="NewPasswordCheck" name="NewPasswordAgain" type="password">
						</div>
					</div>
				</div>
				<input class="input" id="ChangePassword" type="submit"style="display: none;">
				<button id="changePasswordButton" class="button" type="button">?????????????? ????????????</button>
			</form>
			<?
				if (isset($_COOKIE["password_response"])) {
					if ($_COOKIE["password_response"] == false) {
						?>
						<script>
							toggleValidationError("?????????????? ???????????? ?????????????? ????????????.", passwordForm);
						</script>
						<?
						setcookie ("password_response", "", time() - 3600); //???????????????? ????????
					}
				}
			?>
		</div>
	</div>
	<footer>
        <div class="wrapper"></div>
            <div class="footer">
                <div>
                    <a href="tel:8 495 123 45 67"><i class="zmdi zmdi-phone"></i> <p>(+7 (495) 123-45-67)</p></a>
                    <a href="https://maps.google.com/?q='?????????????????????????? ?????????? 60, ????????.2. ????????????'"> <i class="zmdi zmdi-pin-drop"></i><p>(?????????????????????????? ?????????? 60, ????????.2. ????????????)</p></a>
                    <a href="mailto:jew-77-krom@yandex.ru"><i class="zmdi zmdi-email"></i> <p>(jew-77-krom@yandex.ru)</p></a>
                    <a href="#"><i class="zmdi zmdi-facebook"></i></a>
                </div>
                <div>
                    <p> ??2021 K.Max.Jeweller.</p> 
                </div>
            </div>
        </div>   
    </footer>
	<script src="./js/chekTypeBrowser.js"></script>
	<script src="./js/personal.js"></script>
</body>