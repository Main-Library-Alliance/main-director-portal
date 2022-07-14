<?php
include "../../../auth.php";
include "../../../adminOnly.php";
include "../../../config.php";

	    	if (isset($_POST['id'])) {
        	    $id = $_POST['id'];
        	    $ip1 = $_POST['ip1'];
        	    $ip2 = $_POST['ip2'];

        	    
        	    
        	    $stmt = $con->prepare("UPDATE ip_addresses SET ip_addr_1 = ?, ip_addr_2 = ? WHERE id = ?");
        	    $stmt->bind_param("sss", $ip1, $ip2, $id);
        	    $stmt->execute();
        	    header('location: index.php');
        	}
	    ?>
