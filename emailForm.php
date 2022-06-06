<?require_once ("./connection_script.php");?>
<?require_once ("./classes/advancedUserClass.php");?>
<?
session_start();
$sectionsArray = SelectAllSections($conn);
if (isset($_SESSION["login"])) {
	$login = $_SESSION["login"];
	// print_r($login);
} 
else {
	$login = NULL;
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="./img/logo.webp" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>K.Max.Jeweller</title>
</head>
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
				<!-- <li class="nav-item"><a class="nav-link" href="./contacts.php">Контакты</a></li> -->
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
							<li class="nav-sub__item"><a class="nav-sub__link" href="/emailForm.php">Связаться с менеджером</a></li>
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
<hr>
<body>
	<section class="section-form">  
        <div class="wrapper .fields .note">
            <h2  class="title-h2 text-center" >Контакты</h2>
            <p class="after-title text-center">У вас остались вопросы? Отправьте нам сообщение, и мы с вами свяжемся.</p>
            <div class="back-font">
                <form action="/create_ticket_scrpt.php" class="form" method="POST">
					<input class="form__input" type="text" name="theme"  placeholder="Тема" value="">
                    <textarea class="form__textarea"  name="message"   placeholder="Сообщение"></textarea>
                    <button class="form__button" type="submit">Отправить</button>
                </form>
            </div>
        </div>
    </section>
	<footer>
        <div class="wrapper"></div>
            <div class="footer">
                <div>
                    <a href="tel:8 495 123 45 67"><i class="zmdi zmdi-phone"></i> <p>(+7 (495) 123-45-67)</p></a>
                    <a href="https://maps.google.com/?q='Волоколамское шоссе 60, корп.2. Москва'"> <i class="zmdi zmdi-pin-drop"></i><p>(Волоколамское шоссе 60, корп.2. Москва)</p></a>
                    <a href="mailto:jew-77-krom@yandex.ru"><i class="zmdi zmdi-email"></i> <p>(jew-77-krom@yandex.ru)</p></a>
                    <a href="#"><i class="zmdi zmdi-facebook"></i></a>
                </div>
                <div>
                    <p> ©2021 K.Max.Jeweller.</p> 
                </div>
            </div>
        </div>   
    </footer>
	<script src="/js/emailForm.js"></script>
	<script src="./js/chekTypeBrowser.js"></script>
</body>