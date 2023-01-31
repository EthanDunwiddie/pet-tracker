<?php
// reference: https://www.youtube.com/watch?v=gCo6JqGMi30

session_start();
session_unset();
session_destroy();

header("location: ../index.php");
exit();