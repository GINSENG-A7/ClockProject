<?php
    if (isset($_POST['Login'])) {
        $login = $_POST['Login'];
        $password = $_POST['Password'];

        $link = mysqli_connect('localhost','root','','users');

        if ($link == false) {
            echo "Ошибка подключения!";
        }
        $query = mysqli_query($link, "SELECT * FROM user WHERE loginUser = '$login'");

        if (mysqli_num_rows($query)) {

            $detail = mysqli_fetch_assoc($query);

            if (hash_equals(md5($password), $detail['passwordUser'])) {
                setcookie('User', $login, time() + 3600); 
                header("location: ./admin.php");
            } 

            mysqli_free_result($query);
            mysqli_close($link);

            exit;
        }
        header("location: authorization.php");
        exit;
    } 
    else {
        header("location: authorization.php");
        exit;
    }
?>