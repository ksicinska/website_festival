<?php
 session_start();
 include 'db_connection.php';
 $conn = OpenCon();?>
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


    <body>
    <nav class="navbar navbar-expand-lg navbar-light text-white">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav navbar-nav navbar-center">
            <li class="nav-item ">
                <a class="nav-link " href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="events.php">Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="venues.php">Venues</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="registration.php">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li> -->
            <?php
            $user_role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
            if( $user_role == 'admin'){
                
                echo("<li class='nav-item'> <a class='nav-link' href='addEvents.php'>Add Events</a> </li>");
                echo("<li class='nav-item'> <a class='nav-link active ' href='addVenues.php'>Add Venues</a> </li>");
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
                    echo("&emsp; &emsp; &emsp;");
                    echo("Logged in as: $user_login");
                    echo("&emsp; Your role: $user_role");
                    echo("</span>");
                }
            ?>
           
        </div>
        </nav>
        <div class="p-3 mb-2 mt-2 bg-light text-dark">
            <h3>Add Venue</h3>
            <?php
                $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
                if( $message !== '' ){
                    echo("<p>$message</p>\n");
                    $message = '';
                    unset($_SESSION['message']);
                }
            ?>
            <form action = "addvenues_redirect.php" method="POST">
            <div class="form-group">
                <label for="venue_name">Venue name</label>
                <input type="text" class="form-control" name="venue_name" id="venue_name" placeholder="Enter venue name">
           </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="textarea" class="form-control" name="description" id="description">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
           
            
    </body>

</html>