<?require_once("./connection_script.php")?>
<?require_once ("./classes/advancedUserClass.php");?>
<?session_start()?>
<!DOCTYPE html>
<html lang="en">
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
<body>
	<?
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];
		print_r($login);
	} 
	else {
		$login = NULL;
	}
	?>
    <div class = "dis">
        <div class="wrapper">
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
        </div>
        <hr/>
        <section class = "section-decription">
            <div class = "wrapper">
                <div class ="decription">
                    <?php 
                        if (isset( $_GET['id'] ) && !empty( $_GET['id'] )) {
						$entry = SelectEntryByEntryId($conn, $_GET['id']);
						$entry->setImages($conn);
						$entry->setSizes($conn);
                        if(count($entry->imagesArray) > 0) {
                    ?> 
                        <div class = "decription__img">
                            <div class = "decription__click">
                                <?php for($i = 0 ; $i < count($entry->imagesArray); $i++) { ?> 
                                    <div class="decription__item" onclick="ShowImg(this)" data-src="<?=$entry->imagesArray[$i]->path?>">
                                        <img class="img" src="<?=$entry->imagesArray[$i]->path?>" alt="">
                                    </div>
                                <?php } ?>
                            </div>
                            <div class = "decription__show">
                                <img class = "img" src="<?=$entry->imagesArray[0]->path?>" alt="">
                            </div>
                        </div>
                        <div class = "decription__text">
                            <h2 class = "decription__title"> <?=$entry->title?></h2>
                            <div class = "decription__price">
                                <?=$entry->price?> ₽
                            </div>
							<div class = "decription__body">
                                <?=$entry->body?>
                            </div>
                            <div class = "decription__material">
                                Материал: <?=SelectMaterialById($conn, $entry->idMaterial)['value']?>
                            </div>
							<form id="addToCartForm" name="addToCartForm" action="add_to_cart_script.php" method="POST">
								<input id="entryIdInput" name="entryIdInput" type="hidden" value="<?=$_GET['id']?>">
								<?php
								$cart = SelectAllFromOrdersByStatusAndUser($clockUsersConn, $login, 1);
								if ($cart != NULL) {
									$cartItems = SelectEntryesInOrderByOrderId($clockUsersConn, $cart[0]['idOrder']);
									if ($cartItems != NULL) {
										$itemIsNotInCart = true;
										if (empty($entry->sizesArray) || $entry->sizesArray == NULL ) {
											for ($i = 0; $i < count($cartItems); $i++) {
												if ($cartItems[$i]['entry_id'] == $entry->idEntry) {
												?>
													<input class="alreadyInCart" id="addToCartForm" type="submit" value="Уже в корзине" disabled>	
												<?
												$itemIsNotInCart = false;
												break;
												}
											}
											if ($itemIsNotInCart == true) {
												?>
													<input id="addToCartForm" type="submit" value="Добавить в корзину">
												<?
											}
										}
										else {
											// print_r("sfghfdgjgdhkjgfhdj");
											?>
											<select class="sizeSelect" name="sizeIdSelect">
											<?
											// print_r($entry->sizesArray);
											for ($i = 0; $i < count($cartItems); $i++) {
												if ($cartItems[$i]['entry_id'] == $entry->idEntry) {
													$itemIsNotInCart = false;
													//Вывод без одного размера
													if(!empty($entry->sizesArray) && $entry->sizesArray != NULL) {
														for ($j = 0; $j < count($entry->sizesArray); $j++) {
															if($cartItems[$i]['size_id'] != $entry->sizesArray[$j]['idSize']) {
																?>
																<option class="sizeSelect-item" value="<?=$entry->sizesArray[$j]['idSize']?>" id="item-<?=$i?>-<?$j?>"><?=$entry->sizesArray[$j]['value']?></option>
																<?
															}
														}
													}
												}
											}
											if ($itemIsNotInCart == true) {
												// print_r("bbbbbbbb");
												if(!empty($entry->sizesArray) && $entry->sizesArray != NULL) {
													for ($j = 0; $j < count($entry->sizesArray); $j++) {
														print_r($sizesArray[$j]['size_id']);
														?>
														<option class="sizeSelect-item" value="<?=$entry->sizesArray[$j]['idSize']?>" id="item-<?$j?>"><?=$entry->sizesArray[$j]['value']?></option>
														<?
													}
												}
											}
											?>
											</select>
											<input id="addToCartForm" type="submit" value="Добавить в корзину">
											<?
										}
									}
								}
								else {
									if(!empty($entry->sizesArray) && $entry->sizesArray != NULL) {
										?>
										<select class="sizeSelect" name="sizeIdSelect">
										<?
										for ($j = 0; $j < count($entry->sizesArray); $j++) {
											print_r($sizesArray[$j]['size_id']);
											?>
											<option class="sizeSelect-item" value="<?=$entry->sizesArray[$j]['idSize']?>" id="item-<?$j?>"><?=$entry->sizesArray[$j]['value']?></option>
											<?
										}
										?>
										</select>
										<?
									}
								?>
									<input id="addToCartForm" type="submit" value="Добавить в корзину">
								<?
								}
								?>
							</form>
                        </div>
                    <?php }} ?>
                </div>
            </div>
        </section>
		<hr>
		<section class="section-comments">
			<div class="wrapper" style="max-width: 900px !important; padding: 0 12%;">
				<?
				$usersComments = SelectCommentByEntryIdAndUserId($conn, $entry->idEntry, SelectUserByLogin($clockUsersConn, $login)['idUser']);
				if ($login != NULL && $usersComments == NULL) {
					?>
					<form class="newComment-form" action="./send_comment_script.php" method="POST">
						<input type="hidden" name="idEntry" value="<?=$entry->idEntry?>">
						<div class="flexWrapper">
							<p>Ваш отзыв:</p>
							<textarea name="comment" cols="30" rows="10"></textarea>
						</div>
						<p>Оцените товар: </p>
						<div class="simple-rating">
							<div class="simple-rating__items">
								<input id="simple-rating__5" type="radio" class="simple-rating__item" name="simple-rating" value="5">
								<label for="simple-rating__5" class="simple-rating__label"></label>
								<input id="simple-rating__4" type="radio" class="simple-rating__item" name="simple-rating" value="4">
								<label for="simple-rating__4" class="simple-rating__label"></label>
								<input id="simple-rating__3" type="radio" class="simple-rating__item" name="simple-rating" value="3">
								<label for="simple-rating__3" class="simple-rating__label"></label>
								<input id="simple-rating__2" type="radio" class="simple-rating__item" name="simple-rating" value="2">
								<label for="simple-rating__2" class="simple-rating__label"></label>
								<input id="simple-rating__1" type="radio" class="simple-rating__item" name="simple-rating" value="1">
								<label for="simple-rating__1" class="simple-rating__label"></label>
							</div>
						</div>
						<input type="submit" value="Отправить">
					</form>
					<?
				}
				?>
				<div class="commentsWrapper">
					<?
					$commentsArray = SelectAllCommentsByEntryId($conn, $entry->idEntry);
					if ($commentsArray != NULL) {
						for ($i = 0; $i < count($commentsArray); $i++) { 
							$user = SelectUserByUserId($clockUsersConn, $commentsArray[$i]['user_id']);
							?>
							<div class="comment">
								<div class="user">
									<div class="login"><?=$user->login?></div>
									<div class="date"><?=$commentsArray[$i]['date']?></div>
								</div>
								<div class="comment__text">
									<p class="text"><?=$commentsArray[$i]['content']?></p>
									<p>Оценка пользователя: </p>
									<div class="simple-rating">
										<div class="simple-rating__items">
											<input id="simple-recentRating__5" type="radio" class="simple-rating__item" name="simple-rating" value="5" <?if ($commentsArray[$i]['rating'] == 5) {?>checked<?}?>>
											<label for="simple-recentRating__5" class="simple-rating__label"></label>
											<input id="simple-recentRating__4" type="radio" class="simple-rating__item" name="simple-rating" value="4" <?if ($commentsArray[$i]['rating'] == 4) {?>checked<?}?>>
											<label for="simple-recentRating__4" class="simple-rating__label"></label>
											<input id="simple-recentRating__3" type="radio" class="simple-rating__item" name="simple-rating" value="3" <?if ($commentsArray[$i]['rating'] == 3) {?>checked<?}?>>
											<label for="simple-recentRating__3" class="simple-rating__label"></label>
											<input id="simple-recentRating__2" type="radio" class="simple-rating__item" name="simple-rating" value="2" <?if ($commentsArray[$i]['rating'] == 2) {?>checked<?}?>>
											<label for="simple-recentRating__2" class="simple-rating__label"></label>
											<input id="simple-recentRating__1" type="radio" class="simple-rating__item" name="simple-rating" value="1" <?if ($commentsArray[$i]['rating'] == 1) {?>checked<?}?>>
											<label for="simple-recentRating__1" class="simple-rating__label"></label>
										</div>
									</div>
								</div>
							</div>
							<?
						}
					}
					?>
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
        <script src="./js/jquery.js"></script>
        <script src="./js/slick.min.js"></script>
        <script src="./js/customizationSliderSlick.js"></script>
		<script src="./js/chekTypeBrowser.js"></script>
		<script src="./js/description.js"></script>
    </div>
</body>
</html>