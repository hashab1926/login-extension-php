<?php
header("Access-Control-Allow-Origin: *");
$conn = new mysqli("localhost", "root", "", "prevent_multilogin");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
