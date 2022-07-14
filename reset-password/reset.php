<?php
include "../config.php";

if (isset($_POST["username"]) && isset($_POST["action"]) &&
    ($_POST["action"] == "update")) {
    $error = "";
    $pass1 = mysqli_real_escape_string($con, $_POST["pass1"]);
    $pass2 = mysqli_real_escape_string($con, $_POST["pass2"]);
    $username = $_POST["username"];
    $curDate = date("Y-m-d H:i:s");
    if ($pass1 != $pass2) {
         echo "<div style='color:red; font-weight:bold; text-align:center;'>Error: Passwords must match.</div>";
    } else {
        $hashed_pass = password_hash($pass1, PASSWORD_DEFAULT);
        mysqli_query($con, "UPDATE users SET password ='" . $hashed_pass . "', passwordChanged = 1 WHERE `username`='" . $username . "';");

        mysqli_query($con, "DELETE FROM `password_reset_temp` WHERE `username`='" . $username . "';");

        echo "<div style='color:green; font-weight:bold; text-align:center;'>Success! Please wait while you are being redirected.</div>";
         header('location: ../portal/');
    }
}
?>