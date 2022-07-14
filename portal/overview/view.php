<!DOCTYPE html>
<?php
include "../../auth.php";
?>
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>IT/Technology Data</title>
      <link rel="stylesheet" href="../../assets/css/style.css">
    </head>
        <body>
            <div class="portalContainer">
                <?php include '../header.php'; ?>
                <div class="flex">
                    <?php include '../../portal/sidebar.php'; ?>
                    <main>
                        <h1>Library Overview</h1>
                        
                        
                        <p>This page displays data that is unique to your library.</p>
                        <p>If you see something here which is incorrect or needs to be changed, please open a ticket by clicking the link in the header.</p>
        

                        <?php 
                        
                        include '../../config.php';
                        
                        
                        // if logged in as maintech, allow the GET request
                        if ($username == "MAINTECH") {
                            
                            if (isset($_GET['libraries'])) {
                                $name = $_GET['libraries'];
                            }
                        
                        } else {
                            // if not logged in as maintech, the username will always be the library abbreviation
                            $name = $username;
                        }
                            $stmt = $con->prepare("SELECT libraries.id, libraries.library_name, libraries.library_abbr, ip_addresses.ip_addr_1, ip_addresses.ip_addr_2, data_table.admin_pw, data_table.menu_page, data_table.wifi_page, technical_contacts.tech_contact_one_name, technical_contacts.tech_contact_one_email, technical_contacts.tech_contact_two_name, technical_contacts.tech_contact_two_email, data_table.library_email, data_table.google_drive, envisionware.envisionware, envisionware.env_pc_res, envisionware.env_lpt_print, envisionware.env_aam, envisionware.env_mobile_print, envisionware.client_pcs, envisionware.bw_email, envisionware.color_email, envisionware.web_portal, mobile_app.username, mobile_app.password, aspen.url, data_table.magellan_user, data_table.magellan_pass, deep_freeze.license_count, diagram_survey.diagramLastUpdate, diagram_survey.surveyLastUpdate FROM libraries JOIN technical_contacts ON libraries.id = technical_contacts.library_id JOIN data_table ON data_table.id = libraries.id JOIN envisionware ON libraries.id = envisionware.library_id JOIN deep_freeze ON libraries.id = deep_freeze.library_id JOIN mobile_app ON libraries.id = mobile_app.library_id JOIN ip_addresses ON libraries.id = ip_addresses.library_id JOIN aspen ON libraries.id = aspen.library_id JOIN diagram_survey ON libraries.id = diagram_survey.library_id WHERE libraries.library_abbr = ?");
                            $stmt->bind_param("s", $name);
                            $stmt->execute();
                            $result = $stmt->get_result();
                             while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $name = $row['library_name'];
                                $abbr = $row['library_abbr'];
                                $ip1 = $row['ip_addr_1'];
                                $ip2 = $row['ip_addr_2'];
                                $adminpw = $row['admin_pw'];
                                $menu = $row['menu_page'];
                                $wifi = $row['wifi_page'];
                                $tc1name = $row['tech_contact_one_name'];
                                $tc2name = $row['tech_contact_two_name'];
                                $tc1email = $row['tech_contact_one_email'];
                                $tc2email = $row['tech_contact_two_email'];
                                $email = $row['library_email'];
                                $drive = $row['google_drive'];
                                $env = $row['envisionware'];
                                $pcres = $row['env_pc_res'];
                                $lpt = $row['env_lpt_print'];
                                $aam = $row['env_aam'];
                                $mps = $row['env_mobile_print'];
                                $envclients = $row['client_pcs'];
                                $maguser = $row['magellan_user'];
                                $magpass = $row['magellan_pass'];
                                $dflicenses = $row['license_count'];
                                $diagramLastUpdate = $row['diagramLastUpdate'];
                                $surveyLastUpdate = $row['surveyLastUpdate'];
                                $aspenurl = $row['url'];
                                $mobileuser = $row['username'];
                                $mobilepass = $row['password'];
                                $bwemail = $row['bw_email'];
                                $coloremail = $row['color_email'];
                                $webportal = $row['web_portal'];
                                
                                //echo "<p>You are viewing information for " . $name . " Library</p>";
                                
                                if ($_SESSION["username"] == "maintech") {
                                ?>
                                    <form method="POST" action="edit/edit.php">
                                        <input type="hidden" name="libraries" value="<?php echo $name; ?>">
                                        <input type="submit" class="btn" name="editLibrary" value="Edit">
                                    </form>
                                    <?php } ?>
<table>
    <thead>
        <th>Item</th>
        <th>Value</th>
    </thead>
    <tbody>
        <tr>
            <td class="label">Abbr.</td>
            <td><?php echo $abbr; ?></td>
        </tr>
        
        <?php 
        // only show if not empty
        if (!empty($adminpw)) { ?>
            <tr>
                <td class="label">PC/DF Admin PW</td>
                <td><?php echo $adminpw; ?></td>
            </tr>
        <?php } ?>
         <tr>
            <td class="label">Deep Freeze License #</td>
        <?php 
    		echo "<td>" . $dflicenses . "</td>";
    	
    	?>
    	
        
    </tr>
    
    
            <?php
        if (!empty($ip1)) { ?>
            <tr>
                <td class="label">IP Address #1</td>
                <td><?php echo $ip1 ?></td>
            </tr>
        <?php } ?>
        
        <?php if (!empty($ip2)) { ?>
        <tr><td class="label">IP Address #2</td>
        <td><?php echo $ip2 ?></td>
        </tr>
        <?php } ?>

        <tr>
            <td class="label">Tech Contact Name</td>
            <td><?php echo $tc1name ?></td>
        </tr>
        <tr>
            <td class="label">Tech Contact Email</td>
            <td><a href="mailto:<?php echo $tc1email; ?>"><?php echo $tc1email; ?></a></td>
        </tr>
        <tr>
            <td class="label">Backup Tech Contact Name</td>
            <td><?php echo $tc2name; ?></td>
        </tr>
        <tr>
            <td class="label">Backup Tech Contact Email</td>
            <td><a href="mailto:<?php echo $tc2email; ?>"><?php echo $tc2email; ?></a></td>
        </tr>
        <tr>
            <td class="label">Email?</td>
            <td><?php 
            if ($email !== "MAIN") {
                echo "Other";
            } else {
                echo "MAIN Gmail";
            }?></td>
        </tr>
        <tr>
            <td class="label">Drive?</td>
            <td><?php 
            if ($drive === 0) {
                echo "No";
            } else {
                echo "Yes";
            }?></td>
        </tr>
        
            <?php 
            if ($env === 0) {
                //echo "No";
            } else {
                //echo "Yes";
                ?>
        <tr>
            <td class="label">Envisionware<td>
        </tr>
        <tr>
            <td class="label">&nbsp;&nbsp;&nbsp;&nbsp; License Count</td>
            <td><?php echo $envclients; ?></td>
        </tr>
        <tr>
            <td class="label">&nbsp;&nbsp;&nbsp;&nbsp; PC Reservation</td>
            <td><?php 
            if ($pcres === 0) {
                echo "No";
            } else {
                echo "Yes";
            }?></td>
        </tr>
        <tr>
            <td class="label">&nbsp;&nbsp;&nbsp;&nbsp; LPT One Printing</td>
            <td><?php 
            if ($lpt === 0) {
                echo "No";
            } else {
                echo "Yes";
            }?></td>
        </tr>
        <tr>
            <td class="label">&nbsp;&nbsp;&nbsp;&nbsp; Account Management</td>
            <td><?php 
            if ($aam === 0) {
                echo "No";
            } else {
                echo "Yes";
            }?></td>
        </tr>
        
        <tr>
            <td class="label">&nbsp;&nbsp;&nbsp;&nbsp; Wireless Printing</td>
            <td><?php 
            if ($mps === 0) {
                echo "No";
            } else {
                echo "Yes";
            }?></td>
        </tr>
        <tr> <td class="label">&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Black & White Email</td>
        <td> <?php echo $bwemail; ?></td>
        </tr>
        <tr><td class="label">&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Color Email</td>
        <td><?php echo $coloremail; ?></td>
        </tr>
        <tr>
            <td class="label">&nbsp;&nbsp;&nbsp;&nbsp; Web Portal</td>
            <td><a href="<?php echo $webportal; ?>" target="_blank"><?php echo $webportal; ?></a></td>
        </tr>
        
        <?php }?>
        

                <tr>
            <td class="label">Menu Page?</td>
            <td><?php 
            if ($menu === 0) {
                echo "No";
            } else {
                echo "Yes";
            }?></td>
        </tr>
        <tr>
            <td class="label">Wifi Stats?</td>
            <td><?php 
            if ($wifi === 0) {
                echo "No";
            } else {
                echo "Yes";
            }?></td>
        </tr>
        <tr>
            <td class="label">Network Diagram</td>
            <td><?php 
            $networkDiagram = '/home/mainlib/public_html/library-data/network-surveys/' . $abbr . '-diagram.pdf';
            if (file_exists($networkDiagram)) {
                echo "<a href='/network-surveys/" . $abbr . "-diagram.pdf' target='_blank'>View</a><br>";
                echo "<em class='lastEdit'>Last Updated: ";
                echo $diagramLastUpdate;
                echo "</em>";
            } else {
                echo "None uploaded yet";
            }
            
            
            
            ?></td>
            
        </tr>
        <tr>
            <td class="label">Network Survey</td>
            <td><?php 
            $networkDiagram = '/home/mainlib/public_html/library-data/network-surveys/' . $abbr . '-survey.pdf';
            if (file_exists($networkDiagram)) {
                echo "<a href='/network-surveys/" . $abbr . "-survey.pdf' target='_blank'>View</a><br>";
                echo "<em class='lastEdit'>Last Updated: ";
                echo $surveyLastUpdate;
                echo "</em>";
            } else {
                echo "None uploaded yet";
            }
            
            
            
            ?></td>
            </tr>
            <tr>
                <td class="label">Aspen URL</td>
                <td><a href='<?php echo $aspenurl; ?>' target="_blank"><?php echo $aspenurl; ?></a></td>
            </tr>
            <tr>
                <td class="label">Magellan URL</td>
                <td><a href="https://mainlib.org/wp-admin" target="_blank">https://mainlib.org/wp-admin</a></td>
            </tr>
            <tr>
            <td class="label">-- Magellan Username</td>
            <td><?php echo $maguser; ?></td>
        </tr>
        <tr>
            <td class="label">-- Magellan Password</td>
            <td><?php echo $magpass; ?></td>
            
        </tr>
        <tr>
            <td class="label">Mobile App URL</td>
            <td><a href="https://admin-iius1.sol.us/" target="_blank">https://admin-iius1.sol.us/</a></td>
        </tr>
        <tr>
            <td class="label">-- Mobile App Username</td>
            <td><?php echo $mobileuser; ?></td>
        </tr>
        <tr>
            <td class="label">-- Mobile App Password</td>
            <td><?php echo $mobilepass; ?></td>
        </tr>
          
    </table>
    <?php
    if ($_SESSION["username"] == "maintech") {
                                ?>
        <form method="POST" action="../edit/edit.php">
            <input type="hidden" name="libraries" value="<? echo $name; ?>">
            <input type="submit" class="btn" name="editLibrary" value="Edit">
        </form>
                                    <?php } ?>
        <style>
            .label {
                font-weight:bold;
            }
        </style>
        <?php
     }

?>