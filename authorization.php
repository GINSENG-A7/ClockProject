<?php
if (isset($_COOKIE['User'])) {
    header("location: ./admin.php");
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
                <form action="checkPassword.php" method="POST">
                    <div class="wrapper-inputs">
                        <input class="input" name="Login" id="login" type="text" placeholder="Логин"><br>
                        <input class="input" name="Password" id="password" type="password" placeholder="Пароль"><br>
                    </div>
					<span class="line"></span>
                    <div class="wrapper-buttons">
						<input class="button" type="submit">
						<input class="button" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </body>

</html>