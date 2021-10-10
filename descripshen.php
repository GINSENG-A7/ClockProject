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
<body >
    <div class = "dis">
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
        <section class = "section-decription">
            <div class = "wrapper">
                <div class ="decription">
                    <div class = "decription__img">
                        <div class = "decription__click">
                            <div class="decription__item" onclick="ShowImg(this)" data-src="../img/clock/2a1ee2_6d0605a686e644269f03180a85bf6881_mv2.webp">
                                <img class = "img" src="../img/clock/2a1ee2_6d0605a686e644269f03180a85bf6881_mv2.webp" alt="">
                            </div>
                            <div class="decription__item" onclick="ShowImg(this)" data-src="../img/clock/2a1ee2_b7d9e76fb7ed4bafa73e7ec7f246d8d7_mv2.webp">
                                <img class = "img" src="../img/clock/2a1ee2_b7d9e76fb7ed4bafa73e7ec7f246d8d7_mv2.webp" alt="">
                            </div>
                        </div>
                        <div class = "decription__show">
                            <img class = "img" src="../img/clock/2a1ee2_6d0605a686e644269f03180a85bf6881_mv2.webp" alt="">
                        </div>
                    </div>
                    <div class = "decription__text">
                        <h2 class = "decription__title">Браслет для часов "SKULL"</h2>
                        <div class = "decription__price">
                            35 000,00 ₽Цена
                        </div>
                        <div class = "decription__body">
                            Браслет для мужских часов из серебра 925 пробы и натуральных камней 
                            (тигровый глаз) ручной работы. При изготовлении браслета возможно 
                            использовать другие камни (чёрный агат, гранат, шунгит и другие).
                            Браслет возможно адаптировать к любым часам.
                        </div>
                    </div>
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
    </div>
</body>
</html>