<?php
//reference: https://www.youtube.com/watch?v=gCo6JqGMi30&list=LL&index=1&t=5194s

session_start();
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css" />
        <link rel="stylesheet" type="text/css" href="./css/signupform.css" />
        <link rel="stylesheet" type="text/css" href="./css/slider.css" />
       <title>website</title> 
    </head>
    
    <body>
        
        <header>
            <div class="nav-container">
                <a href = "index.php"><img src="img/webLogo.png" alt="logo" class="logo"></a>
                <nav>
                    <ul class="nav-links">
                        <li><a href = "index.php">Home</a></li>
                        <li><a href = "about.php">About</a></li>
                        <li><a href = "contact.php">Contact</a></li>
                    </ul>
                    <ul>
                        <?php
                        if(isset($_SESSION["useruid"])){
                            echo "<a href = 'profile.php'><button type='button' class='btn'>Profile</button></a>";
                            echo "<a href = 'includes/logout.inc.php'><button type='button' class='btn'>Log Out</button></a>";
                        }
                        else{
                            echo "<a href = 'login.php'><button type='button' class='btn'>Log In</button></a>";
                            echo "<a href = 'signup.php'><button type='button' class='btn'>Sign Up</button></a>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </header>