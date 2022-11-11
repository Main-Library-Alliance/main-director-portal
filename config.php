<?php

$host = "${DB_HOSTNAME}";
$user = "${DB_USERNAME}"; 
$password = "${DB_PASSWORD}";
$dbname = "${DB_NAME}";

$con = mysqli_connect($host, $user, $password, $dbname);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
