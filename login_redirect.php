<?php
    include 'db_connection.php';
    $conn = OpenCon();
    session_start();

    if( isset($_POST['login']) || isset($_POST['password']) ){
        $login = $_POST['login'];
        $password = $_POST['password'];

        $_SESSION['message'] = '';
        $_SESSION['user_id'] = '';
        $_SESSION['username'] = '';
        $_SESSION['role'] = '';

        if( isset($_POST['login']) && is_string($_POST['password'])){

            $user_exists = false;
            $query    = "SELECT * FROM `users` WHERE `login` ='$login'
                   AND password='" . md5($password) . "'";
            $result = $conn->query($query);
            $rows = mysqli_num_rows($result);
            if($rows == 1){
                $user_exists = true;
                foreach ($result as $v) {
                    $_SESSION['username'] = $v['login'];
                    $_SESSION['role'] = $v['role'];
                }
            }
            $result->free();

            if($user_exists){
                //zaloguj
                $query    = "SELECT `user_id` FROM `users` WHERE `login` ='$login'
                   AND password='" . md5($password) . "'";
                $result = $conn->query($query);
                $resultstring = $result->fetch_row()[0];
                // $_SESSION['message'] = "Id usera: $resultstring";
                $_SESSION['user_id'] = $resultstring;
                $result->free();
                $_SESSION['message'] = "Jesteś zalogowany";

                header("Location: home.php");
                return;
            }
            else {
                // jesli uzytkownik nie istnieje
                $_SESSION['message'] = "Login lub hasło są niepoprawne";
                header("Location: login.php");
                return;
            }
        }
        else {
            $_SESSION['message'] = "Uzupełnij dane";
            header("Location: login.php");
            return;
        }
    }
    else {
        $_SESSION['message'] = "Uzupełnij pola";
        header("Location: login.php");
        return;
    }

    CloseCon($conn);
?>

