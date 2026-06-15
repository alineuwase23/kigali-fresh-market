<?php
$host = "localhost";
$user = "kigali";
$password = "kigali123";
$database = "kigali_fresh_market";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>