<?php
// reference: https://www.youtube.com/watch?v=gCo6JqGMi30

if(isset($_POST["submit"])){
   
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    if(emptyInputlogin($username, $pwd) !== false){
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    
    loginUser($conn, $username, $pwd);
}
else{
    header("location: ../login.php");
    exit();
}