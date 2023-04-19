<?php
    include 'db_connection.php';
    $conn = OpenCon();
    session_start();

    if( isset($_POST['login']) || isset($_POST['password']) ){
        $login = $_POST['login'];
        $password = $_POST['password'];
        
        $_SESSION['message'] = '';
        $_SESSION['username'] = '';
        $_SESSION['role'] = '';

        if( isset($_POST['login']) && is_string($_POST['password']) && strlen($login) >= 3 && strlen($password) >= 5){

            $login_not_in_db = true;
            $result = $conn->query("SELECT * FROM `users`");
            foreach ($result as $v) {
                if($v["login"] == $login){
                    $login_not_in_db = false;
                }
            }
            $result->free();

            if($login_not_in_db){
                //co robimy jak jest git
                $stmt = $conn->prepare("INSERT INTO `users`(`login`, `password`, `role`) VALUES (?, ?, ?)");
                $role = "user";
                $stmt->bind_param("sss", $login, md5($password), $role);
                $stmt->execute();
                $stmt->close();
                $_SESSION['message'] = "Dodano nowego uzytkownika!";
                header("Location: registration.php");
                return;
            }
            elseif(!$login_not_in_db) {
                //co robimy jesli login juz istnieje
                $_SESSION['message'] = "Ten login jest zajęty";
                header("Location: registration.php");
                return;
            }
            else {
                $_SESSION['message'] = "Error";
                header("Location: registration.php");
                return;
            }
        }
        else {
            $_SESSION['message'] = "Podano nieprawidłowe dane";
            header("Location: registration.php");
            return;
        }
    }
    else {
        $_SESSION['message'] = "Uzupelnij pola";
        header("Location: registration.php");
        return;
    }

    CloseCon($conn);
?>

