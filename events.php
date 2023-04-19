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

    <body>
    <nav class="navbar navbar-expand-lg navbar-light text-white">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav navbar-nav navbar-center">
            <li class="nav-item ">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="events.php">Events</a>
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
                    echo("&emsp; &emsp; &emsp;");
                    echo("Logged in as: $user_login");
                    echo("&emsp; Your role: $user_role");
                    echo("</span>");
                }
            ?>
           
        </div>
        </nav>

        <div class="p-3 mb-2 mt-2 bg-light text-dark">
            <main class="parent">
                <div class="child">         
                <h3> Our events: </h3>
                    <table>
                        <tr> 
                            <th> Date </th>                             
                            <th> Gates open </th>
                            <th> Venue </th>
                            <th> Artist </th>
                        </tr>
                        <?php
                            include 'db_connection.php';
                            $conn = OpenCon();

                            $result = $conn->query("SELECT * FROM events JOIN venues ON events.venue_id=venues.venue_id");

                            if( $user_login !== '' ){                                 
                                    
                                if( $user_role == 'user'){
                                    if($result->num_rows >0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr><td>" . $row["date"]. "</td><td>" . $row["time"] . 
                                            "</td><td>" . $row["venue_name"] . "</td><td>" . $row["artist"] . 
                                            "</td><td>" . '<input type="submit" value="Buy ticket" class="button" name="insert" id="'. $row["event_id"] .'"/>' . "</td></tr>";
        
                                        }
                                        echo "</table>";
                                    }
                                    $result->free();
                                }
                                elseif( $user_role == 'admin'){
                                    echo("<h3>Manage the events</h3>");
                                    if($result->num_rows >0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr><td>" . $row["date"]. "</td><td>" . $row["time"] . 
                                            "</td><td>" . $row["venue_name"] . "</td><td>" . $row["artist"] . 
                                            "</td><td>" . '<input type="submit" value="Delete" class="button" name="insert" id="'. $row["event_id"] .'"/>' . "</td></tr>";
        
                                        }
                                        echo "</table>";
                                    }
                                    $result->free();
                                }
                            }
                            else {
                                if($result->num_rows >0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr><td>" . $row["date"]. "</td><td>" . $row["time"] . 
                                        "</td><td>" . $row["venue_name"] . "</td><td>" . $row["artist"];        
                                    }
                                    echo "</table>";
                                }
                                $result->free();
                            }
            
                            CloseCon($conn);
                        ?>

                    <br>
                </div>
            </main>
        </div>
    </body>
</html>