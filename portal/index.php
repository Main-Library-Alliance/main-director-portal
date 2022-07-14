<?php
include "../auth.php";
        ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MAIN Portal</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        
    </head>
    <body>
        <div class="portalContainer">
            <?php include "../header.php"; ?>
        <div class="flex">


<?php
            include "../config.php";

    		include "sidebar.php";
    		
    		            ?>
    		            
    		            <main>
    		            <h1>MAIN Director Portal</h1>
    		            <?php 
    		            
    		            echo "<p class='welcome'>Welcome, <strong>" . $username . " Library Director!</strong></p>" 
    		            ?>
    		            
    		            <p>This is a website with a central database which stores important data about your library.</p>
    		            
    		            <?php
    		            // this checks whether the password has been initially changed from the default. If it has not, it will automatically route the user to the change-password page.
    		            $stmt = $con->prepare("SELECT passwordChanged FROM users WHERE username = ?");
    		            $stmt->bind_param("s", $username);
                    	$stmt->execute();
                        $result = $stmt->get_result();
                    	while ($row = $result->fetch_assoc()) {
                    	    $passwordChanged = $row['passwordChanged'];
                    	    //echo $passwordChanged;
                    	    if ($passwordChanged !== 1) {
                    	        header('location: ../reset-password/');
                    	    } else {
                    	        
                   

    		            
    		            ?>
    		            
    		            </main>
    		            <?php
    		            
                    	    }
                    	}
                    	$stmt->close();
    		            
    		            
    		        
	 
	    ?>

        </div>
    </body>
</html>


