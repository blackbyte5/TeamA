<?php

session_start();
// Create connection
$conn = mysqli_connect("localhost", "root", "");

$db = mysqli_select_db($conn,"iserve");


?>
