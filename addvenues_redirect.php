<?php
    include 'db_connection.php';
    $conn = OpenCon();
    session_start();

    if( isset($_POST['venue_name']) || isset($_POST['description']) ){
        $venue_name = $_POST['venue_name'];
        $description = $_POST['description'];
        
        $_SESSION['message'] = '';
        // $_SESSION['venue_name'] = '';
        // $_SESSION['description'] = '';

        if( isset($_POST['venue_name']) || isset($_POST['description']) && strlen($venue_name) >= 3 && strlen($description) >=0){

            $venue_name_not_in_db = true;
            $result = $conn->query("SELECT * FROM `venues`");
            foreach ($result as $v) {
                if($v["venue_name"] == $venue_name){
                    $venue_name_not_in_db = false;
                }
            }
            $result->free();

            if($venue_name_not_in_db){
                //co robimy jak jest git
                $stmt = $conn->prepare("INSERT INTO `venues`(`venue_name`, `description`) VALUES (?, ?)");
                $stmt->bind_param("ss", $venue_name,  $description);
                $stmt->execute();
                $stmt->close();
                $_SESSION['message'] = "Dodano nową lokalizację!";
                header("Location: addEvents.php");
                return;
            }
            elseif(!$venue_name_not_in_db) {
                //co robimy jesli login juz istnieje
                $_SESSION['message'] = "Takie miejsce już istnieje";
                header("Location: addEvents.php");
                return;
            }
            else {
                $_SESSION['message'] = "Error";
                header("Location: addEvents.php");
                return;
            }
        }
        else {
            $_SESSION['message'] = "Podano nieprawidłowe dane";
            header("Location: addEvents.php");
            return;
        }
    }
    else {
        $_SESSION['message'] = "Uzupelnij pola";
        header("Location: addEvents.php");
        return;
    }

    CloseCon($conn);
?>
