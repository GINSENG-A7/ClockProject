<?include "./connection_script.php"?>
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
    <title>Личный кабинет</title>
</head>
<body>
	<?
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];
		// print_r($login);
	} 
	else {
		$login = NULL;
	}
	?>    
	<div class="wrapper">
		<header class="header">
			<div class="header__logo">
				<a href='' class="header__logo-linkWrapper">
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
							<a class="nav-link" href="./shop.php?id=1">Часы</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="./shop.php?id=2">Украшения</a>
							<span class="nav-arrow"></span>
							<ul class="nav-sub">
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=2">Браслеты</a></li>
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=3">Кольца</a></li>
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=4">Подвески</a></li>
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=5">Цепи</a></li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="./shop.php?id=6">Аксессуары</a>
							<span class="nav-arrow"></span>
							<ul class="nav-sub">
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=6">Ремни</a></li>
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=7">Бритвы</a></li>
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=8">Портмоне</a></li>
								<li class="nav-sub__item"><a class="nav-sub__link" href="./shop.php?id=9">Брелки</a></li>
							</ul>
						</li>
						<li class="nav-item"><a class="nav-link" href="./contacts.php">Контакты</a></li>
						<li class="nav-item">
							<a class="nav-link" <?if ($login == NULL) {echo('href="./userSingUpOrLogIn.php"');}?>>
								<i class="fa fa-user" style="font-size:24px"></i>
							</a>
							<?
							if ($login != NULL) {
								?>
								<span class="nav-arrow"></span>
								<ul class="nav-sub">
									<li class="nav-sub__item"><a class="nav-sub__link" href="/cart.php">Корзина</a></li>
									<li class="nav-sub__item"><a class="nav-sub__link" href="/recentOrders.php">Заказы</a></li>
									<li class="nav-sub__item"><a class="nav-sub__link" href="/personal.php">Личный кабинет</a></li>
									<li class="nav-sub__item"><a class="nav-sub__link" href="">Связаться с менеджером</a></li>
									<li class="nav-sub__item">
										<form id="exit_form" action="/exit_script.php" method="post" style="display: none;">
											<input id="exit_input" type="submit" name="exit_input" style="display: none;">
										</form>
										<a id="exit_link" class="nav-sub__link" href="">Выйти</a>
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
	</div>
	<div class="wrapper">
		<div class="personal">
			<form class="personal__data-form" action="">
				<div class="wrapper-inputs">
					<input class="input" id="Login" name="Login" type="text" placeholder="Логин">
					<input class="input" id="Password" name="Password" type="text" placeholder="Пароль">
					<input class="input" id="Name" name="Name" type="text" placeholder="Имя">
					<input class="input" id="Surname" name="Surname" type="text" placeholder="Фамилия">
					<input class="input" id="Patronymic" name="Patronymic" type="text" placeholder="Отчество">
					<input class="input" id="Address" name="Address" type="text" placeholder="Адрес">
					<input class="input" id="PostIndex" name="PostIndex" type="text" placeholder="Почтовый индекс">
					<input class="input" id="Email" name="Email" type="text" placeholder="Эл. почта">

					<input class="input" id="SingUp" type="submit"style="display: none;">
				</div>
			</form>
			<form class="personal__password-form" action="">

			</form>
		</div>
	</div>
	<script src="./js/chekTypeBrowser.js"></script>
</body>