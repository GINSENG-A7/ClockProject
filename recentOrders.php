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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/cart.css" rel="stylesheet">
    <link rel="shortcut icon" href="./img/logo.webp" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Заказы</title>
</head>
<body>
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
	</div>
	<section class="section-orders-items">
		<h2  class="title-h2 text-center">Ваши активные заказы</h2>
		<div class="rows_of_orders">
			<?
			$orders = SelectAllFromOrdersByStatusAndUser($clockUsersConn, $login, 2);
			if ($orders != NULL && !empty($orders)) {
				for ($i = 0; $i < count($orders); $i++) {
				$totalPrice = 0;
				?>
				<div class="rows__order">
					<div class="order">
						<div class="order-orderDate">
							<p>Дата заказа: </p>
							<p><?=$orders[$i]["order_date"]?></p>
						</div>
						<!-- <div class="order-paidDate">

						</div> -->
						<div class="order-discount">
							<p>Скидка на момент заказа:</p>
							<p><?=$orders[$i]["historicalDiscount"]?> %</p>
						</div>

						<div class="entryes">
							<?
							$entryesInOrderArray = SelectEntryesInOrderByOrderId($clockUsersConn, $orders[$i]['idOrder']);
							if ($entryesInOrderArray != NULL && !empty($entryesInOrderArray)) {
								for ($j = 0; $j < count($entryesInOrderArray); $j++) {
									$totalPrice += $entryesInOrderArray[$j]["historicalPrice"] - ($entryesInOrderArray[$j]["historicalPrice"] * $order[$i]["historicalDiscount"]);
									$entry = SelectEntryByEntryId($conn, $entryesInOrderArray[$j]['entry_id']);
									$entry->setImages($conn);
									// print_r($entry->imagesArray[0]->path);
									?>
									<div class="entryWrapper">
										<div class="entry-img">
											<a class="wrap_link" href="./descripshen.php?id=<?=$entry->idEntry?>">
												<div class = "img" style="background-image: url('<?=$entry->imagesArray[0]->path?>')">
					
												</div>
											</a>
										</div>
										<div class="entry-description">
											<a class="wrap_link" href="./descripshen.php?id=<?=$entry->idEntry?>">
												<div class="title">
													<?=$entry->title?>
												</div>
												<div class="price">
													<?=$entry->price - ($entry->price * $order[$i]['historicalDiscount'])?> руб
												</div>
											</a>
										</div>
										<?
										if ($entryesInOrderArray[$j]["size_id"] != NULL) {
											?>
											<div class="entry-size">
												<a class="wrap_link" href="./descripshen.php?id=<?=$entry->idEntry?>">
													<div class="size-title">Размер: </div>
													<div class="size-value"><?=$entryesInOrderArray[$j]["size_id"]?></div>
												</a>
											</div>
											<?
										}
										?>
									</div>
									<?
								}
							}
							elseif ($entryesInOrderArray == NULL && empty($entryesInOrderArray)) {
								?>
								<div class="noItemsInCart">
									<h2>У вас нет текущих заказов</h2>
								</div>
								<?
							}					
							?>
						</div>
						<div class="order-totalPrice">
							<p>Итоговая стоимость: </p>	
							<p><?=$totalPrice?> ₽</p>
						</div>
					</div>
				</div>
				<?
				}
			}
			?>
		</div>
	</section>
	<section class="section-orders-items">
		<h2  class="title-h2 text-center">Ваши предыдущие заказы</h2>
		<div class="rows_of_orders">
			<?
			$orders = SelectAllFromOrdersByStatusAndUser($clockUsersConn, $login, 4);
			if ($orders != NULL && !empty($orders)) {
				for ($i = 0; $i < count($orders); $i++) {
				$totalPrice = 0;
				?>
				<div class="rows__order">
					<div class="order">
						<div class="order-orderDate">
							<p>Дата заказа: </p>
							<p><?=$orders[$i]["order_date"]?></p>
						</div>
						<!-- <div class="order-paidDate">

						</div> -->
						<div class="order-discount">
							<p>Скидка на момент заказа:</p>
							<p><?=$orders[$i]["historicalDiscount"]?> %</p>
						</div>

						<div class="entryes">
							<?
							$entryesInOrderArray = SelectEntryesInOrderByOrderId($clockUsersConn, $orders[$i]['idOrder']);
							if ($entryesInOrderArray != NULL && !empty($entryesInOrderArray)) {
								for ($j = 0; $j < count($entryesInOrderArray); $j++) {
									$totalPrice += $entryesInOrderArray[$j]["historicalPrice"] - ($entryesInOrderArray[$j]["historicalPrice"] * $order[$i]["historicalDiscount"]);
									$entry = SelectEntryByEntryId($conn, $entryesInOrderArray[$j]['entry_id']);
									$entry->setImages($conn);
									// print_r($entry->imagesArray[0]->path);
									?>
									<div class="entryWrapper">
										<div class="entry-img">
											<a class="wrap_link" href="./descripshen.php?id=<?=$entry->idEntry?>">
												<div class = "img" style="background-image: url('<?=$entry->imagesArray[0]->path?>')">
					
												</div>
											</a>
										</div>
										<div class="entry-description">
											<a class="wrap_link" href="./descripshen.php?id=<?=$entry->idEntry?>">
												<div class="title">
													<?=$entry->title?>
												</div>
												<div class="price">
													<?=$entry->price - ($entry->price * $order[$i]['historicalDiscount'])?> руб
												</div>
											</a>
										</div>
										<?
										if ($entryesInOrderArray[$j]["size_id"] != NULL) {
											?>
											<div class="entry-size">
												<a class="wrap_link" href="./descripshen.php?id=<?=$entry->idEntry?>">
													<div class="size-title">Размер: </div>
													<div class="size-value"><?=$entryesInOrderArray[$j]["size_id"]?></div>
												</a>
											</div>
											<?
										}
										?>
									</div>
									<?
								}
							}
							elseif ($entryesInOrderArray == NULL && empty($entryesInOrderArray)) {
								?>
								<div class="noItemsInCart">
									<h2>Вы не совершали заказов</h2>
								</div>
								<?
							}					
							?>
						</div>
						<div class="order-totalPrice">
							<p>Итоговая стоимость: </p>	
							<p><?=$totalPrice?> ₽</p>
						</div>
					</div>
				</div>
				<?
				}
			}
			else {
				?>
				<h2 class="empty__message"></h2>
				<?
			}
			?>
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
	<script src="./js/chekTypeBrowser.js"></script>
</body>