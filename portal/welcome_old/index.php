<!DOCTYPE html>
<?php
        session_start();
        if (!isset($_SESSION["username"])) {
            header("Location: ../../login/");
            exit();
        } else {
       $name = $_SESSION["username"];
?>
<html>
<head>
  <meta charset="UTF-8">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="scripts/jquery.tablesorter.min.js"></script>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <div class="content">
    
    <H1>Welcome to MAIN!</H1>
    

<?php 

include '../../config.php';


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
    ?>
      <?php echo $introduction; ?> at the <strong><?php echo $name ?> library</strong>.</p>
       
        <section>
            <h2>Staff Website</h2>
            <?php echo $staffSite; ?>
        
        <section id="main-university">
            <div class="subitems">
                <h3>MAIN University</h3>
                <?php echo $mainUniversity ?>
            </div>
        </section>
        
        <section>
            <h2>IT Department</h2>
            <?php echo $itDept; ?>
        </section>
        
        
        <div class="subitems">
        <section id="group-purchase">         
          <h3>Rolling Group Purchasing</h3>
          <?php echo $groupPurchase; ?>
        </section>
        
        <section id="network-diagram">
            <h3>Network Diagram</h3>
            <?php echo $networkDiag; ?>
            <?php 
                $networkDiagram = '/home/mainlib/public_html/library-data/network-surveys/' . $abbr . '-diagram.pdf';
                if (file_exists($networkDiagram)) {
                    echo "You can view " . $name . " Library's network survey <a href='/network-surveys/" . $abbr . "-diagram.pdf' target='_blank'>here</a> or right-click and 'save as' to save a local copy.";
                    echo "If you suspect this is out date...";
                }
                
                
                
                ?>
        </section>
        
        <section id="tech-contacts">
          <h3>Technology Contacts</h3>
        
        
            <?php 
            
            
            if (empty($tc1name)) {
                echo '<p><strong>Your library does not have a primary tech contact.</strong>If you\'d like to add one, please <a href="https://support.mainlib.org/portal/en/newticket" target="_blank">submit a ticket</a>.</p>';
                
            } else {
            echo '<p>Your library\'s <strong>primary</strong> tech contact is <a href="mailto:' . $tc1email . '">' . $tc1name . '</a>.';
            }
            
            
            
            if (empty($tc2name)) {
                 echo '<p><strong>Your library does not have a secondary tech contact.</strong> If you\'d like to add one, please <a href="https://support.mainlib.org/portal/en/newticket" target="_blank">submit a ticket</a>.</p>';
            } else {
            echo '<p>Your library\'s <strong>secondary</strong> tech contact is <a href="mailto:' . $tc2email . '">' . $tc2name . '</a>.';
            } 
            
            echo $tcDesc;
            ?>
        
        
        </section>
        
        <?php if ($env !== 0) {
              ?>
        <section id="envisionware">
            <h3>Envisionware</h3>
            <?php echo $envDesc; ?>
        
            <?php 
            
            $pcresLinks = "<li><a href='https://staff.mainlib.org/knowledge-base/how-to-bypass-the-envisionware-pc-reservation-screen/' target='_blank'>How to Bypass the Envisionware PC Reservation Screen</a></li><li><a href='https://staff.mainlib.org/knowledge-base/understanding-pc-res-log-files/' target='_blank'>Understanding PC Res Logs</a></li><li><a href='https://staff.mainlib.org/knowledge-base/envisionware-pc-usage-statistics/' target='_blank'>Generating PC Usage Statistics with Envisionware</a>";
            $lptLinks = "<li><a href='https://staff.mainlib.org/knowledge-base/envisionware-printing-statistics/' target='_blank'>How to Generate Printing Statistics</a></li>";
            $aamLinks = "<li><a href='https://staff.mainlib.org/knowledge-base/using-aam-with-envisionware/' target='_blank'>Using AAM with Envisionware</a></li>";
            $mpsLinks = "<li><a href='https://staff.mainlib.org/knowledge-base/printing-wirelessly-via-printeron/' target='_blank'>Printing Wirelessly via PrinterOn</a></li>";
            
            
            if ($pcres !== 0) {
                echo "<details><summary>PC Reservation (Time Management)</summary><p>PC Reservation allows you to manage the amount of time your patrons can spend on the public PCs. It allows you to set <strong>time limits</strong> and require users to log in to PCs with their <strong>library card number</strong>.</p></details>";
            }
            if ($lpt !== 0) {
                echo "<details><summary>LPT One (Print Management)</summary><p>LPT One allows you to track and manage patron print jobs. Jobs are usually sent to a release station and then released by a staff member or the patron (if you have a print release terminal).</details>";
            }
            if ($mps !== 0) {
                echo "<details><summary>PrinterOn (Mobile Printing)</summary><p>PrinterOn allows patrons to send print jobs via email, a website, or a mobile app - from anywhere in the world! These jobs are usually released from a release station by a staff member or the patron.</details>";
            }
            if ($aam !== 0) {
                echo "<details><summary>AAM (Patron Account Balance)</summary><p>AAM allows patrons to store a <strong>cash balance</strong> on their library card. All of the libraries that use AAM share the same database, so patrons can use their balance at any AAM-supported library.</details>";
            }
            echo "</ul>";
?>
                <div class="links">
                  <ul>
                      <li><a href="https://staff.mainlib.org/knowledge-base/envisionware-down/" target="_blank">Help! Envisionware is down!</a></li>
                      <?php 
                      if ($pcres !== 0) {
                      echo $pcresLinks; 
                      } 
                      if ($lpt !== 0) {
                      echo $lptLinks;
                      }
                      if ($aam !==0) {
                          echo $aamLinks;
                      }
                      if ($mps !==0) {
                          echo $mpsLinks;
                      }
                      
                      
                      ?>
                      
                  </ul>
                </div>
              </section>
              <?php       }
            ?>
            
              <section id="email">
                <h3>Email</h3>
                <?php 
                if ($email !== "MAIN") {
                    echo "<p>Your library is not currently using MAIN Gmail. This means you are most likely either using your own library's Gmail account, JerseyConnect, or a townwide email system.</p>";
                    echo "<div class='links'><ul><li><a href='https://staff.mainlib.org/knowledge-base/jerseyconnect-faq/' target='_blank'>JerseyConnect FAQ</a></li></ul></div>";
                } else {
                    echo "<p>Your library is currently using MAIN Gmail</p>";
                    echo "<div class='links'><ul><li><a href='https://staff.mainlib.org/knowledge-base/configuring-outlook-with-gmail/' target='_blank'>How to configure Outlook with Gmail</a></li><li><a href='https://staff.mainlib.org/knowledge-base/how-to-forward-e-mails-to-another-account-using-gmail/' target='_blank'>How to forward emails to another account</a></li><li><a href='https://staff.mainlib.org/knowledge-base/how-to-create-a-filter-in-gmail/' target='_blank'>How to create an email filter</a></li></ul>";
                }
                ?>
                </section>
                
                <section id="google-drive">
                    <h3>Google Drive</h3>
                    <?php 
                    $googleDriveInfo = "<p><img class='sm' src='/assets/drive-icon.png' align='left'>Google Drive is a cloud storage solution that MAIN currently recommends for backing up important data. Regardless of whether your library uses MAIN Gmail, MAIN offers Google Drive as an option to every location.</p>";
                    $googleDriveLinks = "<div class='links'><ul><li><a href='https://staff.mainlib.org/knowledge-base/how-to-access-files-that-have-been-shared-with-me/' target='_blank'>How to access files that have been shared with me</a></li><li><a href='https://staff.mainlib.org/knowledge-base/how-to-share-a-file-or-folder-on-google-drive/' target='_blank'>How to share a file or folder</a></li><li><a href='https://staff.mainlib.org/knowledge-base/how-to-share-a-link-to-a-file-or-folder/' target='_blank'>How to share a link to a file or folder</a></li><li><a href='https://staff.mainlib.org/knowledge-base/what-are-shared-drives-and-how-do-they-differ-from-my-drive/' target='_blank'>What are Shared Drives and how do they differ from My Drive?</a></li><li><a href='https://staff.mainlib.org/knowledge-base/what-is-drive-file-stream/' target='_blank'>What is Drive for Desktop?</a></li></ul> </div>";
                        if ($email === "MAIN") {
                            echo "Your library is using MAIN Gmail, which means you're already all set up for using Drive.";
                            echo $googleDriveInfo;
                            echo $googleDriveLinks;
                        } 
                        
                        if ($drive === 0) {
                            echo "<strong>Your library is not using MAIN's Google Drive.</strong>";
                            echo $googleDriveInfo;
                            
                        }
                        
                        
                        
                        
                        ?>
                

                </section>

                <section id="magellan">
     
                <h2>Magellan</h2>
                <!--<img src="/assets/MAIN-Magellan.gif">-->
               <?echo $magDesc; ?>
                <ul>
                    <li><strong>Your Library Login:</strong> <a href="https://mainlib.org/wp-admin/" target="_blank">https://mainlib.org/wp-admin/</a></li>
                    <li><strong>Library Username: </strong> <?php echo $maguser; ?></li> 
                    <li><strong>Library Password: </strong> <?php echo $magpass; ?></li>
                </ul>
                    <div class="saveThis">
                        <p>Please save this information somewhere you can easily retrieve it.</p>
                    </div>
                    <div class="links">
                        <ul>
                            <li><a href="https://staff.mainlib.org/knowledge-base/making-changes-to-magellan/" target="_blank">How to change library contact info on Magellan</a></li>
                        </ul>
                    </div>
                </section>
                
            <section id="stats">
                <h2>Menu & Wifi Statistics</h2>
                <h3>Menu Statistics</h3>
                <?php 
                if ($menu === 0) {
                    echo '<p>You are not currently getting monthly PC usage (menu page) statistics.</p><p>If you\'d like to start, please <a href="https://support.mainlib.org/portal/en/newticket" target="_blank">open a ticket</a>.</p>';
                } else {
                    echo '<p>You are currently getting monthly PC usage (menu page) statistics. Every month, the report is sent to your library\'s circulation account</p>';
                }
                echo "<h3>Wifi Statistics</h3>";
                if ($wifi === 0) {
                    echo '<p>You are not currently getting monthly wifi usage statistics.</p><p>If you\'d like to start, please <a href="https://support.mainlib.org/portal/en/newticket" target="_blank">open a ticket</a>.</p>';
                } else {
                    echo '<p>You are not currently getting wifi usage (splash page) statistics.</p>
                        <p>These statistics are requested by the state at the end of the year. If you\'re interested in starting to collect them, please <a href="https://support.mainlib.org/portal/en/newticket" target="_blank">open a ticket</a>.</p>';
                }
                
                ?>
                <div class="links">
                    <ul>
                        <li><a href="https://staff.mainlib.org/knowledge-base/monthly-pc-statistics-menu-page/" target="_blank">What is the menu page and how does it generate statistics?</a></li>
                        <li><a href="https://staff.mainlib.org/knowledge-base/how-does-main-generate-wifi-statistics-for-your-library/" target="_blank">How does MAIN generate wifi statistics for your library?</a></li>
                    </ul>
                </div>
        </section>
        
        <section id="closings">
            <h2>Unexpected Closings</h2>
            <p>Sometimes, it's necessary to close your library due to inclement weather, renovations or other unexpected events. When this happens, you can submit your closings to our <a href="https://mainlib.org/closings/" target="_blank">Emergency Closings Tool</a> which can also be found on the Staff website homepage.</p>
            <p>When visiting this page, it will prompt you for a username and password. Both the username and the password is <strong>dementors</strong>.</p>
            <p>Submitting your closing here will add an alert to the MAIN homepage and the library catalog alerting patrons to your closure.</p>
            <div class="links">
            <ul>
                <li><a href="https://mainlib.org/closings/" target="_blank">Emergency Closing Tool</a></li>
                <li><a href="https://staff.mainlib.org/knowledge-base/submit-an-emergency-closing/" target="_blank">How to Submit an Unexpected Closing</a></li>
            </ul>
            </div>
        </section>
    <style>
        h1, h2, h3, p, ul, h3 > p, .img {
    max-width:900px;
    margin:0 auto;
    margin-bottom:20px;
    margin-top:20px;
}

    </style>
        
    <?php
}
}

?>