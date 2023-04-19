<?php
        include 'db_connection.php';
        $conn = OpenCon();
        session_start();

        $_SESSION['username'] = '';
        $_SESSION['role'] = '';
        $_SESSION['message'] = "Jesteś wylogowany";
        header("Location: home.php");

        CloseCon($conn);
    ?>

