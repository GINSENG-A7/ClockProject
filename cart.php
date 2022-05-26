<?require_once("./connection_script.php");?>
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
    <title>K.Max.Jeweller</title>
</head>
<body>
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
								<li class="nav-sub__item"><a class="nav-sub__link" href="">Корзина</a></li>
								<li class="nav-sub__item"><a class="nav-sub__link" href="">Заказы</a></li>
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
	
	<section class="section-orders-items">
		<h2  class="title-h2 text-center">Список товаров</h2>
		<div class="rows_of_entryes">
			<?
			$cart = SelectAllFromOrdersByStatusAndUser($clockUsersConn, $login, 1)[0];
			if ($cart != NULL && !empty($cart)) {
				$entryesInOrderArray = SelectEntryesInOrderByOrderId($clockUsersConn, $cart['idOrder']);
				for ($i = 0; $i < count($entryesInOrderArray); $i++) {
					$entry = SelectEntryByEntryId($conn, $entryesInOrderArray[$i]['entry_id']);
					$entry->setImages($conn);
					$entry->setSizes($conn);
					// print_r($entry->imagesArray[0]->path);
				?>
					<div class="rows__item">
						<form id="deleteItemForm" class="rows__item-purchase_form" method="POST" action="./delete_from_cart_script.php">
							<input id="itemId" name="itemId" type="hidden" value="<?=$entry->idEntry?>">
							<input id="entryesInOrderId" name="entryesInOrderId" type="hidden" value="<?=$entryesInOrderArray[$i]['idEntry_in_order']?>">
							<input id="orderId" name="orderId" type="hidden" value="<?=$cart['idOrder']?>">
							<div class="rows__item-img">
								<a class="wrap_link" href="./descripshen.php?id=<?=$entry->idEntry?>">
									<div class = "img" style="background-image: url('<?=$entry->imagesArray[0]->path?>')">

									</div>
								</a>
							</div>
							<div class="rows__item-none_flex_wrapper">
								<div class="rows__item-flex_wrapper">
									<a class="wrap_link" href="./descripshen.php?id=<?=$entry->idEntry?>">
										<div class="rows__item-description">
											<div class="title">
												<?=$entry->title?>
											</div>
											<div class="price">
												<?=$entry->price?> руб
											</div>
										</div>
									</a>
									<div class="number_wrapper">
										<button class="number-minus" type="button">-</button>
										<input name="itemCount" class="number_input" type="number" min="1" value="1" readonly>
										<button class="number-plus" type="button">+</button>
										<?
										if ($entryesInOrderArray[$i]['size_id'] != NULL) {
											$currentSize = SelectSizeById($conn, $entryesInOrderArray[$i]['size_id']);
										?>
											<select name="sizeIdSelect" class="sizeSelect">
												<?
												for ($j = 0; $j < count($entry->sizesArray); $j++) {
													print_r($currentSize['idSize']);
													print_r($entry->sizesArray[$j]['idSize']);
													print_r('<br>');
													if ($entry->sizesArray[$j]['idSize'] == $currentSize['idSize']) {
														?>
															<option selected="selected" class="sizeSelect-item" value="<?=$entry->sizesArray[$j]['idSize']?>" id="item-<?=$i?>-<?=$j?>"><?=$entry->sizesArray[$j]['value']?></option>
														<?
													}
													else {
														?>
															<option class="sizeSelect-item" value="<?=$entry->sizesArray[$j]['idSize']?>" id="item-<?=$i?>-<?=$j?>"><?=$entry->sizesArray[$j]['value']?></option>
														<?
													}
												}
												?>
											</select>
										<?
										}
										?>
									</div>
								</div>
								<div class="rows__item-submit_wrapper">
									<input class="submit_input" id="formButton" class="purchase_form-btn" type="submit" value="Удалить">
								</div>
							</div>
						</form>
					</div>
				<?
				}
				?>
				<button id="newOrderButton" class="submit_input">Заказать</button>
				<div class="cloneFormsWrapper">

				</div>
			<?
			}
			?>
		</div>
	</section>
</div>
	<script src="./js/chekTypeBrowser.js"></script>
	<script src="./js/cart.js"></script>
</body>