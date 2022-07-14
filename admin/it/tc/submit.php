<?php
include "../../../config.php";

	    	if (isset($_POST['id'])) {
        	    $id = $_POST['id'];
        	    $tc1name = $_POST['tc1name'];
        	    $tc1email = $_POST['tc1email'];
        	    $tc2name = $_POST['tc2name'];
        	    $tc2email = $_POST['tc2email'];
        	    
        	    echo $id, $tc1name, $tc1email, $tc2name, $tc2email;
        	    
        	    $stmt = $con->prepare("UPDATE technical_contacts SET tech_contact_one_name = ?, tech_contact_one_email = ? , tech_contact_two_name = ?, tech_contact_two_email = ? WHERE id = ?");
        	    $stmt->bind_param("sssss", $tc1name, $tc1email, $tc2name, $tc2email, $id);
        	    $stmt->execute();
        	    header('location: index.php');
        	}
	    ?>
