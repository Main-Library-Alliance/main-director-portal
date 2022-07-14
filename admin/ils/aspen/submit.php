<?php
include "../../../auth.php";
include "../../../adminOnly.php";
include "../../../config.php";

	    	if (isset($_POST['id'])) {
        	    $id = $_POST['id'];
        	    $url = $_POST['url'];
        	    
        	    
        	    
        	    $stmt = $con->prepare("UPDATE aspen SET url = ? WHERE id = ?");
        	    $stmt->bind_param("ss", $url, $id);
        	    $stmt->execute();
        	    header('location: index.php');
        	}
	    ?>
