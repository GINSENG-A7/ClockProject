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
                <form id="registrationForm" action="./registration_script.php" method="POST">
                    <div class="wrapper-inputs">
						<input class="input" id="Login" name="Login" type="text" placeholder="Логин">
						<input class="input" id="Password" name="Password" type="text" placeholder="Пароль">
						<input class="input" id="Password" name="PasswordCheck" type="text" placeholder="Повторите пароль">
						<input class="input" id="Name" name="Name" type="text" placeholder="Имя">
						<input class="input" id="Surname" name="Surname" type="text" placeholder="Фамилия">
						<input class="input" id="Patronymic" name="Patronymic" type="text" placeholder="Отчество">
						<!-- <input class="input" id="Address" name="Address" type="text" placeholder="Адрес"> -->
						<input class="input" id="District" name="District" type="text" placeholder="Область">
						<input class="input" id="City" name="City" type="text" placeholder="Город">
						<input class="input" id="Street" name="Street" type="text" placeholder="Улица">
						<input class="input" id="House" name="House" type="text" placeholder="Дом">
						<input class="input" id="Flat" name="Flat" type="text" placeholder="Квартира">
						<input class="input" id="PostIndex" name="PostIndex" type="text" placeholder="Почтовый индекс">
						<input class="input" id="Email" name="Email" type="text" placeholder="Эл. почта">

						<input class="input" id="SingUp" type="submit"style="display: none;">
                    </div>
					<span class="line"></span>
                    <div class="wrapper-buttons">
						<div class="button" id="registerButton"><p>Зарегистрироваться</p></div>
                    </div>
					<?
						if (isset($_COOKIE["authorize_response"])) {
							if ($_COOKIE["authorize_response"] == false) {
								?>
								<script>
									toggleValidationError("Пользователь с таким логином уже зарегистрирован.", form);
								</script>
								<?
								setcookie ("authorize_response", "", time() - 3600); //удаление куки
							}
						}
						if (isset($_COOKIE["email_response"])) {
							if ($_COOKIE["email_response"] == false) {
								?>
								<script>
									toggleValidationError("Пользователь с такой эл. почтой уже зарегистрирован.", form);
								</script>
								<?
								setcookie ("email_response", "", time() - 3600); //удаление куки
							}
						}
					?>
                </form>
            </div>
        </div>
		<script src = "./js/newRegistration.js"></script>
    </body>

</html>