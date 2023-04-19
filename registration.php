<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="calendar.css">
        <link rel="stylesheet" href="login.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="scripts.js"> </script>

    </head>

    <body>
    <nav class="navbar navbar-expand-lg navbar-light text-white" style="background-color: #e3f2fd;">
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

        <div class="container">
            <?php
                $message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
                if( $message !== '' ){
                    echo("<p>$message</p>\n");
                    $message = '';
                    unset($_SESSION['message']);
                }
            ?>

<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">

                  <h4 class="mt-1 mb-5 pb-1">Registration</h4>
                </div>

                <form action = "registration_redirect.php"  class="form" method="POST">
           

           <div class="form-outline mb-4">
                    <input type="text"  name="login" id="login" class="form-control"
                      placeholder="Login" />
                    <label class="form-label" for="form2Example11">Username</label>
                  </div>


          

            <div class="form-outline mb-4">
                    <input type="password" name="password" id="password" class="form-control" />
                    <label class="form-label" for="form2Example22">Password</label>
                  </div>

            <div class="text-center pt-1 mb-5 pb-1">
                    <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" >Register</button>
                   
                  </div>
            </form>
            </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">obrazki
                <!-- <img src="hd-wallpaper-4768501.jpg"
          alt="image"  style="width:300px;height:200px;" > tu jest obrazek ale to nie wygląda jakoś dobrze-->
      </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
       
                </h4>
                <p class="small mb-0">z podpisem</p>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>


<?php
    
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

  </body>
 

  
</html>
<!--   <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
         <p class="link"><a href="registration.php">New Registration</a></p>