<?php
include_once 'header.php';
?>
        
        <div class="container">
            <div>
                
                
                <div class="sign-up">
                    <a href = "index.php"><img src="img/webLogo2.png" class="logo2"></a>
                    <h1> Sign Up</h1>
                    <form action="./includes/signup.inc.php" method="post">
                        <input type="userName" class="input-box" placeholder="Username" name="uid">
                        <input type="email" class="input-box" placeholder="Email" name="email">
                        <input type="password" class="input-box" placeholder="Password" name="pwd">
                        <input type="password" class="input-box" placeholder="Repeat password" name="pwdrepeat">
                        <p><span><input type="checkbox"></span> I agree to the <a href = "">terms and conditions</a></p>
                        <button type="submit" name="submit" class="signup-btn">Sign Up</button>
                        <hr>
                        <p>Already have an account? <a href="login.php">Log in</a></p>
                        
                    </form>
                    
                    <?php
                    if(isset($_GET["error"])){
                        if($_GET["error"] == "emptyinput"){
                            echo"<p>Fill in all fields!</p>";
                        }
                        else if($_GET["error"] == "invaliduid"){
                            echo "<p>Choose a proper username!</p>";
                        }
                        else if($_GET["error"] == "invalidemail"){
                            echo "<p>Choose a proper email!</p>";
                        }
                        else if($_GET["error"] == "passwordsdontmatch"){
                            echo "<p>Passwords do not match!</p>";
                        }
                        else if($_GET["error"] == "stmtfailed"){
                            echo "<p>Something went wrong, try again!</p>";
                        }
                        else if($_GET["error"] == "usernametaken"){
                            echo "<p>Username already taken!</p>";
                        }
                        else if($_GET["error"] == "none"){
                            echo "<p>You have signed up!</p>";
                        }
                    }
                    ?>
                    
                </div>
                
            </div>
        </div>
        
<?php
include_once 'footer.php';
?>