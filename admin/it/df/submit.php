<?php
include "../../../auth.php";
include "../../../adminOnly.php";
include "../../../config.php";

	    	if (isset($_POST['id'])) {
        	    $id = $_POST['id'];
        	    $licenses = $_POST['licensecount'];
        	    
        	    
        	    
        	    $stmt = $con->prepare("UPDATE deep_freeze SET license_count = ? WHERE id = ?");
        	    $stmt->bind_param("ss", $licenses, $id);
        	    $stmt->execute();
        	    header('location: index.php');
        	}
	    ?>
