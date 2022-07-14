<?php
include "../../../auth.php";
include "../../../adminOnly.php";
include "../../../config.php";

	    	if (isset($_POST['id'])) {
	    	    $id = $_POST['id'];
        	    $username = $_POST['username'];
        	    $password = $_POST['password'];
        	    $selfCheck = $_POST['selfCheck'];
        	    $clickCollect = $_POST['clickCollect'];
        	    
        	    echo $id, $username, $password, $selfCheck, $clickCollect;
        	    
        	    $stmt = $con->prepare("UPDATE mobile_app SET username = ?, password = ?, self_check = ?, click_collect = ? WHERE id = ?");
        	    $stmt->bind_param("sssss", $username, $password, $selfCheck, $clickCollect, $id);
        	    $stmt->execute();
        	    header('location: view.php');
        	}
	    ?>