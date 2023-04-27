<!DOCTYPE html>
<?php
include "../../../auth.php";

include "../../../adminOnly.php";
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>Library Overview</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../../../scripts/jquery.tablesorter.min.js"></script>
  <link rel="stylesheet" href="../../../assets/css/style.css">

</head>
<body>
    <div class="portalContainer">
        <?php include '../../../portal/header.php'; ?>
        <div class="flex">
            <?php include '../../../portal/sidebar.php'; ?>
            <main>
                <h1>Library Overview</h1>

<?php 
                        
                        include '../../../config.php';
                        
                      
if (isset($_POST['libraries'])) {
    $name = $_POST['libraries'];
    $stmt = $con->prepare("SELECT libraries.id, libraries.library_name, libraries.library_abbr, ip_addresses.ip_addr_1, ip_addresses.ip_addr_2, data_table.admin_pw, data_table.menu_page, data_table.wifi_page, technical_contacts.tech_contact_one_name, technical_contacts.tech_contact_one_email, technical_contacts.tech_contact_two_name, technical_contacts.tech_contact_two_email, data_table.library_email, data_table.google_drive, envisionware.envisionware, envisionware.env_pc_res, envisionware.env_lpt_print, envisionware.env_aam, envisionware.env_mobile_print, envisionware.client_pcs, envisionware.bw_email, envisionware.color_email, envisionware.web_portal, mobile_app.username, mobile_app.password, aspen.url, data_table.magellan_user, data_table.magellan_pass, deep_freeze.license_count, diagram_survey.diagramLastUpdate, diagram_survey.surveyLastUpdate FROM libraries JOIN technical_contacts ON libraries.id = technical_contacts.library_id JOIN data_table ON data_table.id = libraries.id JOIN envisionware ON libraries.id = envisionware.library_id JOIN deep_freeze ON libraries.id = deep_freeze.library_id JOIN mobile_app ON libraries.id = mobile_app.library_id JOIN ip_addresses ON libraries.id = ip_addresses.library_id JOIN aspen ON libraries.id = aspen.library_id JOIN diagram_survey ON libraries.id = diagram_survey.library_id WHERE libraries.library_name = ?");
    //echo $name;
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
     while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['library_name'];
        $abbr = $row['library_abbr'];
        $license = $row['license_count'];
        $adminpw = $row['admin_pw'];
        $menu = $row['menu_page'];
        $wifi = $row['wifi_page'];
        $tc1name = $row['tech_contact_one_name'];
        $tc2name = $row['tech_contact_two_name'];
        $tc1email = $row['tech_contact_one_email'];
        $tc2email = $row['tech_contact_two_email'];
        $email = $row['library_email'];
        $ip1 = $row['ip_addr_1'];
        $ip2 = $row['ip_addr_2'];
        $drive = $row['google_drive'];
        $client_pcs = $row['client_pcs'];
        $env = $row['envisionware'];
        $pcres = $row['env_pc_res'];
        $lpt = $row['env_lpt_print'];
        $aam = $row['env_aam'];
        $mps = $row['env_mobile_print'];
        $aspenurl = $row['url'];
        $maguser = $row['magellan_user'];
        $magpass = $row['magellan_pass'];
        $diagramupdate = $row['diagramLastUpdate'];
        $surveyupdate = $row['surveyLastUpdate'];
        $mobileuser = $row['username'];
        $mobilepass = $row['password'];
        $bwemail = $row['bw_email'];
        $coloremail = $row['color_email'];
        $webportal = $row['web_portal'];
        echo "<p>You are editing information for <strong>" . $name . " Library</strong></p>";
        ?>
        <table>
            <thead>
                <th>Item</th>
                <th>Value</th>
            </thead>
            <tbody>
                <form method="POST" action="upload.php" enctype="multipart/form-data">
                    <input type="submit" name="saveEdit" class="btn" value="Save" >
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="hidden" name="name" value="<?php echo $name ?>">

            <tr>
                <input type="hidden" name="abbr" value="<?php echo $abbr; ?>">
                <td class="label">PC/DF Admin PW</td>
                <td><input type="text" name="adminpw" value="<?php echo $adminpw; ?>"></td>
            </tr>
            <tr>
                    <td class="label">Deep Freeze License #</td>
            	    
            	<td><input type='text' name='licenseCount' value='<?php echo $license; ?>'></td>
            	
            	
                
            </tr>
                        <tr>
                <td class="label">IP Address #1</td>
                <td><input type="text" name="ip1" value="<?php echo $ip1; ?>"></td>
                
            </tr>
            <tr>
                <td class="label">IP Address #2</td>
                <td><input type="text" name="ip2" value="<?php echo $ip2; ?>"></td>
                
            </tr>
             <tr>
                <td class="label">Tech Contact Name</td>
                <td><input type="text" name="tc1name" value="<?php echo $tc1name ?>"></td>
            </tr>
            <tr>
                <td class="label">Tech Contact Email</td>
                <td><input type="text" name="tc1email" value="<?php echo $tc1email; ?>"></td>
            </tr>
            <tr>
                <td class="label">Backup Tech Contact Name</td>
                <td><input type="text" name="tc2name" value="<?php echo $tc2name; ?>"></td>
            </tr>
            <tr>
                <td class="label">Backup Tech Contact Email</td>
                <td><input type="text" name="tc2email" value="<?php echo $tc2email; ?>"></td>
            </tr>
           
           
            <tr>
                <td class="label">Email?</td>
                <td><?php 
                if ($email !== "MAIN") {
                    echo "<select name='email'>
                    <option value='MAIN'>MAIN</option>
                    <option value='other' selected>Other</option>
                </select>";
                } else {
                    echo "<select name='email'>
                    <option value='MAIN' selected>MAIN</option>
                    <option value='other'>Other</option>
                </select>";
                }?></td>
            </tr>
            

            <tr>
                
            </tr>
            <tr>
                <td class="label">Drive?</td>
                <td><?php 
                if ($drive === 0) {
                    echo "<select name='drive'>
                    <option value='1'>Yes</option>
                    <option value='0' selected>No</option>
                </select>";
                } else {
                    echo "<select name='drive'>
                    <option value='1' selected>Yes</option>
                    <option value='0'>No</option>
                </select>";
                }?></td>
            </tr>
            <tr>
                <td class="label">Envisionware?</td>
                <td><?php 
                if ($env === 0) {
                    echo "<select name='env'>
                    <option value='1'>Yes</option>
                    <option value='0' selected>No</option>
                </select>";
                } else {
                    echo "<select name='env'>
                    <option value='1' selected>Yes</option>
                    <option value='0'>No</option>
                </select>";
                }?></td>
            </tr>
            <tr>
               <td class="label">Client PCs</td>
               <td><input type='text' name='client_pcs' value='<?php echo $client_pcs; ?>'></td>
           </tr>
            <tr>
                <td class="label">----PC Reservation</td>
                <td><?php 
                if ($pcres === 0) {
                    echo "<select name='pcr'>
                    <option value='1'>Yes</option>
                    <option value='0' selected>No</option>
                </select>";
                } else {
                    echo "<select name='pcr'>
                    <option value='1' selected>Yes</option>
                    <option value='0'>No</option>
                </select>";
                }?></td>
            </tr>
            <tr>
                <td class="label">----LPT One Printing</td>
                <td><?php 
                if ($lpt === 0) {
                    echo "<select name='lpt'>
                    <option value='1'>Yes</option>
                    <option value='0' selected>No</option>
                </select>";
                } else {
                    echo "<select name='lpt'>
                    <option value='1' selected>Yes</option>
                    <option value='0'>No</option>
                </select>";
                }?></td>
            </tr>
            <tr>
                <td class="label">----Account Management</td>
                <td><?php 
                if ($aam === 0) {
                    echo "<select name='aam'>
                    <option value='1'>Yes</option>
                    <option value='0' selected>No</option>
                </select>";
                } else {
                    echo "<select name='aam'>
                    <option value='1' selected>Yes</option>
                    <option value='0'>No</option>
                </select>";
                }?></td>
            </tr>
            <tr>
                <td class="label">----Wireless Printing</td>
                <td><?php 
                if ($mps === 0) {
                    echo "<select name='mps'>
                    <option value='1'>Yes</option>
                    <option value='0' selected>No</option>
                </select>";
                } else {
                    echo "<select name='mps'>
                    <option value='1' selected>Yes</option>
                    <option value='0'>No</option>
                </select>";
                }?></td>
            </tr>
           
           <tr>
               <td class="label">Black & White Email</td>
               <td><input type='text' name='bwemail' value='<?php echo $bwemail; ?>'></td>
           </tr>
           <tr>
               <td class="label">Color Email</td>
               <td><input type='text' name='coloremail' value='<?php echo $coloremail; ?>'></td>
           </tr>
           <tr>
               <td class="label">Web Portal</td>
               <td><input type='text' name='webportal' value='<?php echo $webportal; ?>'></td>
           </tr>
           
           
           
             <tr>
                <td class="label">Menu Page?</td>
                <td>
                
                <?php 
                if ($menu === 0) {
                    echo "<select name='menu'>
                    <option value='1'>Yes</option>
                    <option value='0' selected>No</option>
                </select>";
                } else {
                    echo "<select name='menu'>
                    <option value='1' selected>Yes</option>
                    <option value='0'>No</option>
                </select>";
                }?></td>
            </tr>
            <tr>
                <td class="label">Wifi Stats?</td>
                <td><?php 
                if ($wifi === 0) {
                    echo "<select name='wifi'>
                    <option value='1'>Yes</option>
                    <option value='0' selected>No</option>
                </select>";
                } else {
                    echo "<select name='wifi'>
                    <option value='1' selected>Yes</option>
                    <option value='0'>No</option>
                </select>";
                }?></td>
            </tr>
            <tr>
                
             <td class="label">Network Diagram</td>
             <td><?php 
                $networkDiagram = '/home/mainlib/public_html/library-data/network-surveys/' . $abbr . '-diagram.pdf';
                if (file_exists($networkDiagram)) {
                    echo "<a href='/network-surveys/" . $abbr . "-diagram.pdf' target='_blank'>View<br></a>";
                    
                    echo "<em class='lastEdit'>Last Updated: " . $diagramupdate . "</em><br><br><strong>Replace: </strong>";
                } else {
                    echo "None uploaded yet";
                }
                
                
                
                ?><br>
                
                     <input type="hidden" name="libAbbr" value="<?php echo $abbr; ?>">
                 <input type="file" name="networkDiagram" id="upload" class="inputfile" />
                 
                 </td>
            </tr>
            
            <tr>
                <td class="label">Network Survey</td>
                <td><?php 
                $networkDiagram = '/home/mainlib/public_html/library-data/network-surveys/' . $abbr . '-survey.pdf';
                if (file_exists($networkDiagram)) {
                    echo "<a href='/network-surveys/" . $abbr . "-survey.pdf' target='_blank'>View</a><br>";
                    echo "<em class='lastEdit'>Last Updated: " . $surveyupdate . "</em><br><br><strong>Replace: </strong></label><br>";
                } else {
                    echo "None uploaded yet";
                }
                
                
                
                ?><br>
                                     <input type="hidden" name="libAbbr" value="<?php echo $abbr; ?>">
                 <input type="file" name="networkSurvey" id="upload2" class="inputfile" /></td>
                 
            </tr>
            <tr>
                <td class="label">Aspen URL</td>
                <td><input type="text" name="aspen" value="<?php echo $aspenurl; ?>"></td>
            </tr>
             <tr>
                <td class="label">Magellan Username</td>
                <td><input type="text" name="maguser" value="<?php echo $maguser; ?>"></td>
            </tr>
            <tr>
                <td class="label">Magellan Password</td>
                <td><input type="text" name="magpass" value="<?php echo $magpass; ?>"></td>
                
            </tr>
            
                         <tr>
                <td class="label">Mobile App Username</td>
                <td><input type="text" name="mobileuser" value="<?php echo $mobileuser; ?>"></td>
            </tr>
            <tr>
                <td class="label">Mobile App Password</td>
                <td><input type="text" name="mobilepass" value="<?php echo $mobilepass; ?>"></td>
                
            </tr>
            <tr><td></td></td><td><input type="submit" name="saveEdit" class="btn" value="Save" ></td></tr>
            </form>
        </table>
        <style>
            .label {
                font-weight:bold;
            }
        </style>
        <?php
     }
}
?>

