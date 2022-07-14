<?php
        session_start();
         if (!isset($_SESSION["username"])) {
            header("Location: ../login/");
         } else {
             $username = $_SESSION["username"];
         }
        ?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reset Password</title>
        
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>

    <body>
        <div class="portalContainer">
            <?php include "../portal/header.php"; ?>
            <div class="flex">
                <?php include "../portal/sidebar.php"; ?>
                <main>
            <h1>Set Password</h1>
            <p>This is your first time logging in, so please use the fields below to create your own password before proceeding.</p>
            <form method="post" action="index.php" name="update">
                <input type="hidden" name="action" value="update" />
                <label><strong>Enter New Password:</strong></label><br />
                <input type="password" name="pass1" maxlength="15" required /><br>
                <label><strong>Re-Enter New Password:</strong></label><br />
                <input type="password" name="pass2" maxlength="15" required />
                <input type="hidden" name="username" value="<?php echo strtolower($username); ?>" /><br><br>
                <input type="submit" value="Reset" />
            </form>
            
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
         echo "<meta http-equiv='refresh' content='2; URL=/portal/' />";
    }
}
?>
        </div>
    </body>
</html>