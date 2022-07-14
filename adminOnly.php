<?php

// get Username
$username = $_SESSION["username"];
//echo $username;

// this only allows maintech view the page
if ($username !== "maintech") {
    header("Location: /login/");
    exit;
}


?>