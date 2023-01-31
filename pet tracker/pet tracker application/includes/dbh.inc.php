<?php
// reference: https://www.youtube.com/watch?v=gCo6JqGMi30

$serverName = "localhost";
$dBUserName = "ethan.dunwiddie";
$dBPassword = "kUBqE2fWKyc6hAqS";
$dBName = "ethandunwiddie_website";

$conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}