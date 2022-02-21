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
                                <li class="nav-sub__item"><a class="nav-sub__link" href="">Браслеты</a></li>
                                <li class="nav-sub__item"><a class="nav-sub__link" href="">Кольца</a></li>
                                <li class="nav-sub__item"><a class="nav-sub__link" href="">Подвески</a></li>
                                <li class="nav-sub__item"><a class="nav-sub__link" href="">Цепи</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./shop.php?id=3">Аксессуары</a>
                            <span class="nav-arrow"></span>
                            <ul class="nav-sub">
                                <li class="nav-sub__item"><a class="nav-sub__link" href="">Ремни</a></li>
                                <li class="nav-sub__item"><a class="nav-sub__link" href="">Бритвы</a></li>
                                <li class="nav-sub__item"><a class="nav-sub__link" href="">Портмоне</a></li>
                                <li class="nav-sub__item"><a class="nav-sub__link" href="">Брелки</a></li>
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
                </nav>
            </div>
        </header>

    </div>
    <section class="section-auto-slider">
        <div class="slider">
            <?php $entryesBySectionArray = SelectAllFromEntryesBySectionId($conn, 1);
			for($i = 0 ; $i<count($entryesBySectionArray);$i++) { 
				$imagesOfEntry = SelectAllImagesByEntryId($conn, $entryesBySectionArray[$i]['idEntry']);
			?> 
				<div class="slider__item">
					<img src="<?=$imagesOfEntry[0]['path']?>" alt="" srcset="">
				</div>
            <?php  } ?>
        </div>
    </section>
    <section class="section-about">
        <div class="wrapper">
            <h2  class="title-h2 text-center" >Список товаров</h2>
            <div class="card">
                <?php for($i = 0 ; $i < 10; $i++) { ?>
                    <div class="card__item">
                        <a href="./descripshen.php">
                            <div class="card__img">
                                <div class = "img">

                                </div>
                            </div>
                            <div class="card__decription">
                                <div class="card__title">
                                    Часы "TSUNAMI"
                                </div>
                                <div class="card__price">
                                    110(000),00₽
                                </div>
                            </div>
                        </a>
                        <div class="card__btn">
                            <a href="./descripshen.php">Подробнее...</a>
                        </div>
                    </div>
                <?php  } ?>
            </div>
        </div>
    </section>
    <hr/>
    <section class="sectionAdvertisingSlider">
        <div class="wrapper">
            <div class="slider-bottom">
                <?php for($i = 0 ; $i<10;$i++) { ?>
                    <div class="slider-bottom__item">
                        <img   
                            src = "./img//logo.webp"  
                            alt=""
                        />
                    </div>
                <?php  } ?>
            </div>
        </div>
    </section>
    <hr/>
    <section class="section-form">  
        <div class="wrapper .fields .note">
            <h2  class="title-h2 text-center" >Контакты</h2>
            <p class="after-title text-center">У вас остались вопросы? Отправьте нам сообщение!</p>
            <div class="back-font">
                <form action="" class="from" method="post">
                    <input class="from__input" type="text" name="name"  placeholder="Имя" value="">
                    <input class="from__input" type="email" name="email" placeholder="Email" value="">
                    <input class="from__input" type="tel" name="email" placeholder="Номер телефона" value="">
                    <textarea class="from__textarea"  name="message"   placeholder="Сообщение"></textarea>
                    <button class="from__button"  type="submit">Отправить</button>
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
    <script src="./js/jquery.js"></script>
    <script src="./js/slick.min.js"></script>
    <script src="./js/customizationSliderSlick.js"></script>
    <script src = "./js/chekTypeBrowser.js"></script>
    <script src = "./contactform.js"></script>
</body>
</html>