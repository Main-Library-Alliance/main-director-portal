<!DOCTYPE html>
<?php
        session_start();
        if (!isset($_SESSION["username"])) {
            header("Location: ../../login/");
            exit();
        }
        $name = $_SESSION["username"];
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>IT/Technology Data</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="scripts/jquery.tablesorter.min.js"></script>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
    <div class="portalContainer">
        <?php include '../header.php'; ?>
        <div class="flex">
                    <?php include '../sidebar.php'; ?>
        
      <main>

<?php 

include '../../config.php';

$name = $_SESSION["username"];
    $stmt = $con->prepare("SELECT libraries.id, libraries.library_name, libraries.library_abbr, data_table.admin_pw, data_table.menu_page, data_table.wifi_page, technical_contacts.tech_contact_one_name, technical_contacts.tech_contact_one_email, technical_contacts.tech_contact_two_name, technical_contacts.tech_contact_two_email, data_table.library_email, data_table.google_drive, envisionware.envisionware, envisionware.env_pc_res, envisionware.env_lpt_print, envisionware.env_aam, envisionware.env_mobile_print, data_table.magellan_user, data_table.magellan_pass, deep_freeze.license_count, data_table.diagramLastUpdate, data_table.surveyLastUpdate FROM libraries JOIN technical_contacts ON libraries.id = technical_contacts.library_id JOIN data_table ON data_table.id = libraries.id JOIN envisionware ON libraries.id = envisionware.library_id JOIN deep_freeze ON libraries.id = deep_freeze.library_id WHERE libraries.library_abbr = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
     while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['library_name'];
        $abbr = $row['library_abbr'];
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
        $maguser = $row['magellan_user'];
        $magpass = $row['magellan_pass'];
        $diagramLastUpdate = $row['diagramLastUpdate'];
        $surveyLastUpdate = $row['surveyLastUpdate'];
        //echo "<p>You are viewing information for " . $name . " Library</p>";
        ?>
        <h1>IT/Technology Data</h1>
        <p>This page displays IT-related data that is unique to your library.</p>
        <p>If you see something here which is incorrect or needs to be changed, please open a ticket by clicking the link in the header.</p>
        <form method="POST" action="../edit/edit.php">
            <input type="hidden" name="libraries" value="<? echo $name; ?>">
           <!-- <input type="submit" name="editLibrary" value="Edit"> -->
        </form>
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
            <tr>
                <td class="label">PC/DF Admin PW</td>
                <td><?php echo $adminpw; ?></td>
            </tr>
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
            <tr>
                <td class="label">Envisionware?</td>
                <td><?php 
                if ($env === 0) {
                    echo "No";
                } else {
                    echo "Yes";
                }?></td>
            </tr>
            <tr>
                <td class="label">--PC Res?</td>
                <td><?php 
                if ($pcres === 0) {
                    echo "No";
                } else {
                    echo "Yes";
                }?></td>
            </tr>
            <tr>
                <td class="label">--LPT?</td>
                <td><?php 
                if ($lpt === 0) {
                    echo "No";
                } else {
                    echo "Yes";
                }?></td>
            </tr>
            <tr>
                <td class="label">--AAM?</td>
                <td><?php 
                if ($aam === 0) {
                    echo "No";
                } else {
                    echo "Yes";
                }?></td>
            </tr>
            <tr>
                <td class="label">--PDS?</td>
                <td><?php 
                if ($mps === 0) {
                    echo "No";
                } else {
                    echo "Yes";
                }?></td>
            </tr>
            <tr>
                <td class="label">Magellan Username</td>
                <td><?php echo $maguser; ?></td>
            </tr>
            <tr>
                <td class="label">Magellan Password</td>
                <td><?php echo $magpass; ?></td>
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
            
            
            </tr>
        </table>
        </main>
        </div>
        </div>
        
        <?php include '../../footer.php'; ?>
        <style>
            .label {
                font-weight:bold;
            }
        </style>
        <?php
     }
?>