<?php
include "../auth.php";
include "../adminOnly.php";
include "../config.php";

	    	if (isset($_POST['id'])) {
        	    $id = $_POST['id'];
        	    $libraryName = $_POST['libraryName'];
        	    
        	    
        	    
        	    $stmt = $con->prepare("UPDATE libraries SET library_name = ? WHERE id = ?");
        	    $stmt->bind_param("ss", $libraryName, $id);
        	    $stmt->execute();
        	    header('location: library-names.php');
        	}
	    ?>
