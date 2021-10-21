<?include "./connection_script.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="./img/logo.webp" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <title>K.Max.Jeweller</title>
</head>
<body>
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
						<li class="nav-item disappearable">
							<div class="nav-item-textWrapper">
								<span class = "contact-person">K.Max.Jeweller</span>
								<a class="contact-phone phone" href="tel:8-905-534-09-56">8-905-534-09-56</a>
								<a class="contact-phone phone" href="tel:8-499-190-09-56">8-499-190-09-56</a>
							</div>
						</li>
                    </ul>
                    <span class = "number">K.Max.Jeweller : (8 905 534 09 56 (8 499 190 09 56))</span>
                </nav>
            </div>
        </header>

    </div>
    <hr/>
    <section class="section-about">
        <div class="wrapper">
            <h2  class="title-h2 text-center" >Список товаров</h2>
            <div class="card">
            <?php $entryesBySectionArray = SelectAllFromEntryesBySectionId($conn, $_GET['id']);
                for($i = 0 ; $i<count($entryesBySectionArray);$i++) {  
                $img = SelectAllImagesByEntryId($conn, $entryesBySectionArray[$i]['idEntry']);
                if(count($img) > 1) {
                ?> 
                    <div class="card__item">
                        <a href="./descripshen.php">
                            <div class="card__img">
                                <div class = "img " style= "background-image: url('<?=$img[0]['path']?>')">

                                </div>
                                <div class = "img-back" style= "background-image: url('<?=$img[1]['path']?>')">

                                </div>
                            </div>
                            <div class="card__decription">
                                <div class="card__title">
                                    <?=$entryesBySectionArray[$i]['title']?>
                                </div>
                                <div class="card__price">
                                    <?=$entryesBySectionArray[$i]['price']?> руб
                                </div>
                            </div>
                        </a>
                        <div class="card__btn">
                            <a href="./descripshen.php">Подробнее...</a>
                        </div>
                    </div>
                <?php  }}?>
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
    <script src = "./js/chekTypeBrowser.js"></script>
</body>
</html>