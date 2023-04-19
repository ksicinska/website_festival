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
            <li class="nav-item">
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
                echo("<li class='nav-item'> <a class='nav-link ' href='addVenues.php'>Add Venues</a> </li>");
                echo("<li class='nav-item'> <a class='nav-link' href='users.php'>Users</a> </li>");
                }
               
            
            ?>
            <?php
                $user_login = isset($_SESSION['username']) ? $_SESSION['username'] : '';
                if( $user_login !== '' ){
                    echo("<li class='nav-item'> <a class='nav-link active' href='tickets.php'>Tickets</a> </li>");
                    echo("<li class='nav-item'> <a class='nav-link' href='logout.php'>Logout</a> </li>");
                }
                else {
                    // echo("<li class='nav-item'> <a class='nav-link' href='registration.php'>Registration</a> </li>");
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
            <h3>Tickets section</h3>
            <table class="p-3 mb-2 mt-2 bg-light text-dark">
                <tr> 
                    <th> Date </th>                             
                    <th> Artist </th>
                    <th> Price in $ </th>
                </tr>
                <?php
                include 'db_connection.php';
                $conn = OpenCon();

                if( $user_login !== '' ){
                    if( $user_role == 'user'){
                        echo("<h3> Tickets purchased by you: </h3>");
                        $query = 
                        "SELECT * FROM users u
                        JOIN tickets t on t.user_id=u.user_id
                        JOIN events e on t.event_id=e.event_id";
                        //WHERE u.user_id = $user_id";
                        $result = $conn->query($query);
                        if($result->num_rows >0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["date"]. "</td><td>" . $row["artist"] . 
                                "</td><td>" . $row["ticket_price"] . "</td><td>";
                                //echo '<input type="submit" value="Buy ticket" class="button" name="insert" id="'. $row["ticket_id"] .'"/>';
                            }
                            echo "</table>";
                        }
                        $result->free();
                    }
                    elseif( $user_role == 'admin'){
                        echo("<h3> Manage user's tickets!</h3>");
                        $query = 
                        "SELECT * FROM users u
                        JOIN tickets t on t.user_id=u.user_id
                        JOIN events e on t.event_id=e.event_id";
                        $result = $conn->query($query);
                        foreach ($result as $v) {
                            if($result->num_rows >0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr><td>" . $row["date"]. "</td><td>" . $row["artist"] . 
                                    "</td><td>" . $row["ticket_price"] . "</td><td>";
                                    echo '<input type="submit" value="Delete Ticket" class="button" name="delete" id="'. $row["ticket_id"] .'"/>';

                                }
                                echo "</table>";
                            }
                        }
                        $result->free();
                    }
                }
                else {
                    echo("Musisz być zalogowany");
                }

                CloseCon($conn);
            ?>

        </div>

    </body>
</html>