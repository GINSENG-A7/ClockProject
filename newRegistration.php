<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/authoriz.css">
    </head>

    <body>
        <div class="wrapper">
            <div class="container">
                <form id="registration_script.php" action="checkPassword.php" method="POST">
                    <div class="wrapper-inputs">
						<input class="input" id="Login" type="text" placeholder="Логин">
						<input class="input" id="Password" type="text" placeholder="Пароль">
						<input class="input" id="Name" type="text" placeholder="Имя">
						<input class="input" id="Surname" type="text" placeholder="Фамилия">
						<input class="input" id="Patronymic" type="text" placeholder="Отчество">
						<input class="input" id="Address" type="text" placeholder="Адрес">
						<input class="input" id="Email" type="text" placeholder="Эл. почта">

						<input class="input" id="SingUp" type="submit"style="display: none;">
                    </div>
					<span class="line"></span>
                    <div class="wrapper-buttons">
						<div class="button" id="registerButton"><p>Зарегистрироваться</p></div>
                    </div>
                </form>
            </div>
        </div>
		<script src = "./js/newRegistration.js"></script>
    </body>

</html>