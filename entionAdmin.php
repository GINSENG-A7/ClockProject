<?php
    if (isset($_COOKIE['User'])) {
        setcookie('User', "", time() - 186400);
    }
    header("location: ./index.php");
?> 