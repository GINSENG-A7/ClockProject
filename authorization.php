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
                    <div>
                        <input class="input" name="Login" type="text" placeholder="Логин"><br>
                        <input class="input" name="Password" type="password" placeholder="Пароль"><br>
                    </div>
                    <div>
                        <div></div>
                        <input type="submit" class="button">
                    </div>
                </form>
            </div>
        </div>
    </body>

</html>