<?php 
include "../../../config.php";
// date stuff
date_default_timezone_set("US/Eastern");
$date = date("Y-m-d");

$diagramSuffix = "-diagram.";
$surveySuffix = "-survey.";
$abbr = $_POST['libAbbr'];
$suffix;
    // the upload function
    function uploadFile($file, $abbr, $suffix) {
        $abbr = $abbr;
        $suffix = $suffix;
        $file = $file;
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileSize = $file['uploadedFile']['size'];
        $fileType = $file['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        $newFileName = $abbr . $suffix . $fileExtension;
        $allowedfileExtensions = array('pdf', 'jpg');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                $uploadFileDir = '/home/mainlib/public_html/library-data/network-surveys/';
                $dest_path = $uploadFileDir . $newFileName;
                 
                if(move_uploaded_file($fileTmpPath, $dest_path))
                {
                  $message ='File is successfully uploaded.';
                  //echo $message;
                    
                }
                    else{
                      $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                      //echo $message;
                }
                
            }
        }

if (isset($_POST['saveEdit'])) {
    
    
     if (is_uploaded_file($_FILES['networkDiagram']['tmp_name'])) {
    echo 'networkDiagram changed';
    $id = $_POST['id'];
    $diagramLastUpdate = $date;
    $abbr = $_POST['libAbbr'];
    $suffix = $diagramSuffix;
    $file = $_FILES['networkDiagram'];
    uploadFile($file, $abbr, $suffix);
    $stmt = $con->prepare("UPDATE diagram_survey SET diagramLastUpdate = ? WHERE library_id = ?");
      	$stmt->bind_param("ss", $diagramLastUpdate, $id);
      	$stmt->execute();
      	$stmt->close();
    
    }
    
     if (is_uploaded_file($_FILES['networkSurvey']['tmp_name'])) {
        echo 'networkSurvey changed';
    //echo "uploaded";
    $id = $_POST['id'];
    $surveyLastUpdate = $date;
    $abbr = $_POST['libAbbr'];
    $suffix = $surveySuffix;
    $file = $_FILES['networkSurvey'];
    uploadFile($file, $abbr, $suffix);
    $stmt = $con->prepare("UPDATE diagram_survey SET surveyLastUpdate = ? WHERE library_id = ?");
  	$stmt->bind_param("ss", $surveyLastUpdate, $id);
  	$stmt->execute();
  	$stmt->close();
    }
    

        $id = $_POST['id'];
        $name = $_POST['name'];
        $abbreviation = $_POST['abbr'];
        $ip1 = $_POST['ip1'];
        $ip2 = $_POST['ip2'];
        $adminpw = $_POST['adminpw'];
        $license = $_POST['licenseCount'];
        $menu = $_POST['menu'];
        $wifi = $_POST['wifi'];
        $tc1name = $_POST['tc1name'];
        $tc1email = $_POST['tc1email'];
        $tc2name = $_POST['tc2name'];
        $tc2email = $_POST['tc2email'];
        $email = $_POST['email'];
        $drive = $_POST['drive'];
        $client_pcs = $_POST['client_pcs'];
        $env = $_POST['env'];
        $pcr = $_POST['pcr'];
        $lpt = $_POST['lpt'];
        $aam = $_POST['aam'];
        $mps = $_POST['mps'];
        $bwemail = $_POST['bwemail'];
        $coloremail = $_POST['coloremail'];
        $webportal = $_POST['webportal'];
        $maguser = $_POST['maguser'];
        $magpass = $_POST['magpass'];
        $mobileuser = $_POST['mobileuser'];
        $mobilepass = $_POST['mobilepass'];
        $aspen = $_POST['aspen'];
        
        //echo $adminpw;
        

        
        // data_table query
        
        $stmt = $con->prepare("UPDATE data_table SET admin_pw = ?, menu_page = ?, wifi_page = ?, library_email = ?, google_drive = ?, magellan_user = ?, magellan_pass = ? WHERE id = ?");
      	$stmt->bind_param("ssssssss", $adminpw, $menu, $wifi, $email, $drive, $maguser, $magpass, $id);
      	//echo "<br>ID<br>" . $id . "<br>";
      	$stmt->execute();
      	$result = $stmt->get_result();
      	$stmt->close();
      	
      	// technical_contacts query
      	$stmt = $con->prepare("UPDATE technical_contacts SET tech_contact_one_name = ?, tech_contact_one_email = ?, tech_contact_two_name = ?, tech_contact_two_email = ? WHERE library_id = ?");
      	$stmt->bind_param("sssss", $tc1name, $tc1email, $tc2name, $tc2email, $id);
      	$stmt->execute();
      	$stmt->close();
      	
      	
      	// envisionware query
      	$stmt = $con->prepare("UPDATE envisionware SET envisionware = ?, client_pcs = ?, env_pc_res = ?, env_lpt_print = ?, env_aam = ?, env_mobile_print = ?, bw_email = ?, color_email = ?, web_portal = ? WHERE library_id = ?");
      	$stmt->bind_param("sssssssss", $env, $client_pcs, $pcr, $lpt, $aam, $mps, $bwemail, $coloremail, $webportal, $id);
      	$stmt->execute();
      	$stmt->close();
      	
      	// ip_address query
      	$stmt = $con->prepare("UPDATE ip_addresses SET ip_addr_1 = ?, ip_addr_2 = ? WHERE library_id = ?");
      	$stmt->bind_param("sss", $ip1, $ip2, $id);
      	$stmt->execute();
      	$stmt->close();
      	
      	// mobile_app query
      	$stmt = $con->prepare("UPDATE mobile_app SET username = ?, password = ? WHERE library_id = ?");
      	$stmt->bind_param("sss", $mobileuser, $mobilepass, $id);
      	$stmt->execute();
      	$stmt->close();
      	
      	
      	// df query
      	if (isset($license) AND !empty($license)) {
      	$stmt = $con->prepare("UPDATE deep_freeze SET license_count = ? WHERE library_id = ?");
      	$stmt->bind_param("ss", $license, $id);
      	$stmt->execute();
      	$stmt->close();
      	}
      	
      	// aspen query
      	if (isset($aspen) AND !empty($aspen)) {
      	$stmt = $con->prepare("UPDATE aspen SET url = ? WHERE library_id = ?");
      	$stmt->bind_param("ss", $aspen, $id);
      	$stmt->execute();
      	$stmt->close();
      	header("Location: /portal/overview/view.php?libraries=" . $abbr . "&view=Submit");
      	}
    
}

 
      	


?>
