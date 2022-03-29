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
                <form id="loginOrRegisterForm" action="checkPassword.php" method="POST">
                    <div>
                        <input class="input" name="Login" id="loginInput" type="text" placeholder="Логин"><br>
                        <input class="input" name="Password" id="passwordInput" type="password" placeholder="Пароль"><br>
						<input class="input" id="SingIn" type="submit" style="display: none;">
						<input class="input" id="SingInVK" type="submit" style="display: none;">
						<input class="input" id="SingUp" type="submit"style="display: none;">
                    </div>
                    <div class="wrapper-buttons">
                        <div class="button" id="loginButton"><p>Войти</p></div>
						<div class="button" id="loginVKButton"><p>Войти через VK</p></div>
						<div class="button" id="registerButton"><p>Зарегистрироваться</p></div>
                    </div>
                </form>
            </div>
        </div>
		<script src = "./js/userSingUpOrLogin.js"></script>
    </body>

</html>