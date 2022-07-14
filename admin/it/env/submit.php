<?php
include "../../../auth.php";
include "../../../adminOnly.php";
include "../../../config.php";

	    	if (isset($_POST['id'])) {
        	    $id = $_POST['id'];
        	    $model = $_POST['model'];
        	    $os = $_POST['os'];
        	    $svc = $_POST['svc'];
        	    $ip = $_POST['ip'];
        	    $acronis = $_POST['acronis'];
        	    $lpta = $_POST['lpta'];
        	    $jqe = $_POST['jqe'];
        	    $ps = $_POST['ps'];
        	    $pds = $_POST['pds'];
        	    $pcrmc = $_POST['pcrmc'];
        	    $sm = $_POST['sm'];
        	    
        	    
        	    
        	    $stmt = $con->prepare("UPDATE envisionware SET con_model = ?, con_svc_tag = ?, con_os = ?, con_ip = ?, con_acronis = ?, v_LPTA = ?, v_JQE = ?, v_PS = ?, v_PDS = ?, v_PCRMC = ?, v_SM = ? WHERE id = ?");
        	    $stmt->bind_param("ssssssssssss", $model, $svc, $os, $ip, $acronis, $lpta, $jqe, $ps, $pds, $pcrmc, $sm, $id);
        	    $stmt->execute();
        	    header('location: index.php');
        	}
	    ?>
