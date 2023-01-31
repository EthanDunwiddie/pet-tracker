<?php
include_once 'header.php';
?>
        
        <div class="container">
            <div>
                
                
                <div class="sign-up">
                    <a href = "index.php"><img src="img/webLogo2.png" class="logo2"></a>
                    <h1>Log In</h1>
                    <form action="./includes/login.inc.php" method="post">
                        <input type="userName" class="input-box" placeholder="Username/Email" name="uid">
                        <input type="password" class="input-box" placeholder="Password" name="pwd">
                        <button type="submit" name="submit" class="signup-btn">Log In</button>
                        <hr>
                        <p>Already have an account? <a href="signup.php">Sign Up</a></p>
                        
                    </form>
                    
                    <?php
                    if(isset($_GET["error"])){
                        if($_GET["error"] == "emptyinput"){
                            echo"<p>Fill in all fields!</p>";
                        }
                        else if($_GET["error"] == "wronglogin"){
                            echo "<p>Incorrect login information!</p>";
                        }
                    }
                    ?>
                    
                </div>
                
                
            </div>
        </div>
        
<?php
include_once 'footer.php';
?>