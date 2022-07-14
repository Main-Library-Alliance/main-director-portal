<?php
// start session
session_start();

// check if user is logged in
if (!isset($_SESSION["username"])) {
            header("Location: /login/");
} else if ($_SESSION["username"] !== "maintech") {
    header("Location: /portal/");
} else {
     header("Location: /admin/");
}
            
?>