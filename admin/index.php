
<?php 
include "../auth.php";
include "../adminOnly.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MAIN Portal</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        
    </head>
    <body>
        
        <div class="portalContainer">
            <?php include "../portal/header.php"; ?>
    <div class="flex">
        <?php include "../portal/sidebar.php"; ?>
        <main>

        <h1>MAIN Admin Portal</h1>
        <p>Welcome to the MAIN Admin Portal.</p>
        <p>This app was created to help MAIN consolidate and manage the unique customizations of our member libraries.</p>
        <p>Please use the navbar on the left to navigate.</p>
        <p>Not sure where to start? Check out the <strong>Library Overview</strong> and the <strong>Reference Guide</strong>!</p>

        </div>
    </body>
</html>


