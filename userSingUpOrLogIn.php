<?
	setcookie("authorize_response", "true");
	$scriptResponse = true;
	if (isset($_COOKIE["authorize_response"])) {
		if ($_COOKIE["authorize_response"] == "false") {
			$scriptResponse = false;
			setcookie ("authorize_response", "", time() - 3600); //удаление куки
		}
	}
?>
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
                <form id="loginOrRegisterForm" action="./authorize_script.php" method="POST">
                    <div class="wrapper-inputs">
                        <input class="input" name="Login" id="loginInput" type="text" placeholder="Логин"><br>
                        <input class="input" name="Password" id="passwordInput" type="password" placeholder="Пароль"><br>
						<input class="input" id="SingIn" type="submit" style="display: none;">
						<input class="input" id="SingInVK" type="submit" style="display: none;">
						<input class="input" id="SingUp" type="submit"style="display: none;">
                    </div>
					<span class="line"></span>
                    <div class="wrapper-buttons">
                        <div class="button" id="loginButton"><p>Войти</p></div>
						<!-- <div class="button" id="loginVKButton"><p>Войти через VK</p></div> -->
						<div class="button" id="registerButton"><p>Зарегистрироваться</p></div>
                    </div>
                </form>
            </div>
        </div>
		<script src = "./js/userSingUpOrLogin.js"></script>
		<?
		if ($scriptResponse == false) {
			?>
			<script>
				toggleValidationError("Неверный логин или пароль.");
			</script>
			<?
		}
		?>
    </body>

</html>