<!DOCTYPE html>
<?php 
include "../../auth.php";
include "../../adminOnly.php";
?>
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Library Overview</title>
      <link rel="stylesheet" href="../../assets/css/style.css">
    </head>
    <body>
        <div class="portalContainer">
        <?php include '../header.php'; ?>
            
            <div class="flex">
            <?php include '../../portal/sidebar.php'; ?>
            
                <main>
                    <h1>Library Overview - Choose a Library</h1>
                    <form method="GET" action="view.php">
                    <?php include "../../choose-a-library.php"; ?>
                    <input type="submit" id="generateText" name="view" value="Submit">
                    </form>
                </main>
            </div>
        </div>
    </body>
</html>