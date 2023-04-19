<?php
    include 'db_connection.php';
    session_start();
    $user_login = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $user_role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'Buy ticket':
                $param = $_POST['param'];
                insert($param);
                //insert();
                break;
            case 'Delete':
                $param = $_POST['param'];
                delete_event($param);
                break;
            case 'Delete Ticket':
                $param = $_POST['param'];
                delete_ticket($param);
                break;
            case 'Promote to admin':
                $param = $_POST['param'];
                promote_to_admin($param);
                break;
            case 'Remove permission':
                $param = $_POST['param'];
                remove_permission($param);
                break;
        }
    }

    function select() {
        echo "The select function is called.";
        exit;
    }

    function delete_event($event_id) {
        $conn = OpenCon();

        $stmt = $conn->prepare("DELETE FROM events WHERE event_id=$event_id");
        $stmt->execute();
        $stmt->close();

        CloseCon($conn);
        exit;
    }

    function delete_ticket($ticket_id) {
        $conn = OpenCon();
        $stmt = $conn->prepare("DELETE FROM tickets WHERE ticket_id=$ticket_id");
        $stmt->execute();
        $stmt->close();

        CloseCon($conn);
        exit;
    }
    function promote_to_admin($user_id) {
        $conn = OpenCon();
        $stmt = $conn->prepare( "UPDATE `users` SET `role` = 'admin' WHERE `users`.`user_id` = $user_id");
        $stmt->execute();
        $stmt->close();

        CloseCon($conn);
        exit;
    }
    function remove_permission($user_id) {
        $conn = OpenCon();
        $stmt = $conn->prepare( "UPDATE `users` SET `role` = 'user' WHERE `users`.`user_id` = $user_id");
       
        $stmt->execute();
        $stmt->close();

        CloseCon($conn);
        exit;
    }
    function insert($param) {
        // $user_id = 9;
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 9;
        $user_id = (int)$user_id;
        $conn = OpenCon();

        //$result = $conn->query("SELECT * FROM events JOIN venues ON events.venue_id=venues.venue_id");
        $stmt = $conn->prepare("INSERT INTO `tickets`(`event_id`, `user_id`) VALUES (?, ?)");
        $stmt->bind_param("ss", $param, $user_id);
        $stmt->execute();
        $stmt->close();

        //$result->free();

        CloseCon($conn);
        echo $param . " The insert function is called.";
        //echo "User id: " . $user_id . "  And session user id: " . $_SESSION['user_id'];
        exit;
    }
?>
