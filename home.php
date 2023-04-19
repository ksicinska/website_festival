<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="calendar.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="scripts.js"> </script>

    </head>

    <body style="background: none;">

        <nav class="navbar navbar-expand-lg navbar-light text-white">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav navbar-nav navbar-center">
            <li class="nav-item active">
                <a class="nav-link active" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="events.php">Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="venues.php">Venues</a>
            </li>

            <?php
            $user_role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
            if( $user_role == 'admin'){
                
                echo("<li class='nav-item'> <a class='nav-link' href='addEvents.php'>Add Events</a> </li>");
                echo("<li class='nav-item'> <a class='nav-link ' href='addVenues.php'>Add Venues</a> </li>");
                echo("<li class='nav-item'> <a class='nav-link' href='users.php'>Users</a> </li>");
                }
               
            
            ?>
            <?php
                $user_login = isset($_SESSION['username']) ? $_SESSION['username'] : '';
                if( $user_login !== '' ){
                    echo("<li class='nav-item'> <a class='nav-link' href='tickets.php'>Tickets</a> </li>");
                    echo("<li class='nav-item'> <a class='nav-link' href='logout.php'>Logout</a> </li>");
                }
                else {
                    echo("<li class='nav-item'> <a class='nav-link' href='registration.php'>Registration</a> </li>");
                    echo("<li class='nav-item'> <a class='nav-link' href='login.php'>Login</a> </li>");
                }
            ?>
           
            </ul>
            <?php
                if( $user_login !== '' ){
                    $user_role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
                    echo("<span class='navbar-text text-white'>");
                    echo("&emsp; &emsp; &emsp; &emsp;");
                    echo("Hello $user_login");
                    echo("&emsp;");
                    echo("</span>");
                }
            ?>
           
        </div>
        </nav>

        <div class="p-3 mb-2 mt-2 bg-light">
            <h3> See performances organized by us! </h3>
            <div class="topnav">
                <div class="content">
                    <?php
                        include 'calendar.php';
                        //add events to the calendar
                        include 'db_connection.php';
                        $conn = OpenCon();
                        $result = $conn->query("SELECT * FROM events");
                        $calendar=new Calendar('2023-03-01');
                        $calendar1= new Calendar('2023-04-01');
                        foreach($result as $r) {
                            $calendar->add_event($r['artist'], $r['date']);
                            $calendar1->add_event($r['artist'], $r['date']);
                        }
                        echo $calendar;
                        '</br>';
                        echo $calendar1;
                    ?>
                </div>  
            </div> 



            <!-- <?php
                $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
                if( $message !== '' ){
                    echo("<p>$message</p>\n");
                    $message = '';
                    unset($_SESSION['message']);
                }

                // check if logged in
                $user_login = isset($_SESSION['username']) ? $_SESSION['username'] : '';
                $user_role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
                if( $user_login !== '' ){
                    echo("<p>Logged in as: $user_login </p>\n");
                    echo("<p>User role is: $user_role </p>\n");
                }
            ?> -->
        </div>
        

    </body>
</html>