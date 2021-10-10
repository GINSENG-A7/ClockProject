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
                <img src="./img/logo.webp" alt="logo">
                <div>
                    <span>K.Max.Jeweller</span>
                    <span>( 8-903-745-62-18 )</span>
                </div>
            </div>
            <div class="header__menu">
                <div class="header__menu-icon">
                    <span></span>
                </div>
                <nav class="header__menu-body">
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link" href="./">Главная</a></li>
                        <li class="nav-item"><a class="nav-link" href="./shop.php?id=1">Часы</a></li>
                        <li class="nav-item"><a class="nav-link" href="./shop.php?id=2">Украшения</a></li>
                        <li class="nav-item"><a class="nav-link" href="./shop.php?id=3">Аксессуары</a></li>
                        <li class="nav-item"><a class="nav-link" href="./shop.php?id=4">Контакты</a></li>
                    </ul>
                </nav>
            </div>
        </header>
    </div>
    <hr/>
    <section class="section-about">
        <div class="wrapper">
            <div class="card">
                <?php for($i = 0 ; $i<10;$i++) { ?>
                    <div class="card__item">
                        <div class="card__img">
                            <div class = "img">

                            </div>
                        </div>
                        <div class="card__decription">
                            <div class="card__title">
                                Часы "TSUNAMI"
                            </div>
                            <div class="card__price">
                                110 000,00 ₽
                            </div>
                        </div>
                        <div class="card__btn">
                            Подробнее...
                        </div>
                    </div>
                <?php  } ?>
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
</body>
</html>