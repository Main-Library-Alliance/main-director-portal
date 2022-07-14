<!DOCTYPE html>
    <?php
    include "../../auth.php";
    ?>
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>MAIN Reference Guide</title>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="../../assets/css/style.css">
    </head>
        <body>
            <div class="portalContainer">
                <?php include "../header.php"; ?>
                <div class="flex">
                   <?php include '../../portal/sidebar.php'; ?>
                    <main>
                        <H1>Director Reference Guide</H1>
    

                        <?php 
                        
                        include "../../config.php";
                        
                        
                        // defines the username
                        $username = $_SESSION["username"];
                        
                        // if logged in as maintech, allow the GET request
                        if ($username == "maintech") {
                            
                            if (isset($_GET['libraries'])) {
                                $name = $_GET['libraries'];
                            }
                        
                        } else {
                        // else the name is the username
                        $name = $username;
                        } 
                       // echo $name;
    $stmt = $con->prepare("SELECT libraries.id, libraries.library_name, libraries.library_abbr, ip_addresses.ip_addr_1, ip_addresses.ip_addr_2, data_table.admin_pw, data_table.menu_page, data_table.wifi_page, technical_contacts.tech_contact_one_name, technical_contacts.tech_contact_one_email, technical_contacts.tech_contact_two_name, technical_contacts.tech_contact_two_email, data_table.library_email, data_table.google_drive, envisionware.envisionware, envisionware.env_pc_res, envisionware.env_lpt_print, envisionware.env_aam, envisionware.env_mobile_print, envisionware.client_pcs, envisionware.bw_email, envisionware.color_email, envisionware.web_portal, mobile_app.username, mobile_app.password, aspen.url, data_table.magellan_user, data_table.magellan_pass, deep_freeze.license_count, diagram_survey.diagramLastUpdate, diagram_survey.surveyLastUpdate FROM libraries JOIN technical_contacts ON libraries.id = technical_contacts.library_id JOIN data_table ON data_table.id = libraries.id JOIN envisionware ON libraries.id = envisionware.library_id JOIN deep_freeze ON libraries.id = deep_freeze.library_id JOIN mobile_app ON libraries.id = mobile_app.library_id JOIN ip_addresses ON libraries.id = ip_addresses.library_id JOIN aspen ON libraries.id = aspen.library_id JOIN diagram_survey ON libraries.id = diagram_survey.library_id WHERE libraries.library_abbr = ?");
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
        $clients = $row['client_pcs'];
        $bwemail = $row['bw_email'];
        $coloremail = $row['color_email'];
        $webportal = $row['web_portal'];
        $maguser = $row['magellan_user'];
        $magpass = $row['magellan_pass'];
        $mobileuser = $row['username'];
        $mobilepass = $row['password'];
        $aspenurl = $row['url'];
        
        include '../../welcomeDescriptions.php';
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
        
        <?php 
        //$abbr = strtolower($abbr);
        //echo $abbr;
        $networkDiagram = '/home/mainlib/public_html/library-data/network-surveys/' . $abbr . '-diagram.pdf';
        if (file_exists($networkDiagram)) {?>
        <section id="network">
            <h3>Network</h3>
            <p>Your network refers to your connection to the internet, and connections between devices in the library.</p>
            
            <h4>Diagram and Survey</h4>
            
            <?php 
            
                $networkDiagram = '/home/mainlib/public_html/library-data/network-surveys/' . $abbr . '-diagram.pdf';
                if (file_exists($networkDiagram)) {
                    echo "<p><span class='info'>You can view " . $name . " Library's network diagram <a href='/network-surveys/" . $abbr . "-diagram.pdf' target='_blank'>here</a>.</span></p>";
                     echo $networkDiag;
                    echo "<p>The <strong>network survey</strong> accompanies the diagram and has data about your network.</p><p><span class='info'>You can view " . $name . " Library's network survey document <a href='/network-surveys/" . $abbr . "-survey.pdf' target='_blank'>here</a>.</span></p>";
                    
                }
               
        
                
                ?>
                
            <h4>ISP Contact Information</h4>
            <p>These numbers are for contacting your ISP about internet outages.</p>
            <ul>
                <li><strong>Comcast Xfinity</strong> - (800) 934-6489</li>
                <li><strong>Optimum</strong> - (516) 803-1073</li>
                <li><strong>Verizon FIOS</strong> - (800) 837-4966</li>
            </ul>
        </section>
        <?php } ?>
        <section id="tech-contacts">
          <h3>Technology Contacts</h3>
        
        
            <?php 
            
            
            if (empty($tc1name)) {
                echo '<p><strong class="alert">Your library does not have a primary tech contact.</strong> <p>If you\'d like to add one, please <a href="https://support.mainlib.org/portal/en/newticket" target="_blank">submit a ticket</a>.</p>';
                
            } else {
            echo '<p><span class="info">Your library\'s <strong>primary</strong> tech contact is <a href="mailto:' . $tc1email . '">' . $tc1name . '</a>.</p>';
            }
            
            
            
            if (empty($tc2name)) {
                 echo '<p><strong class="alert">Your library does not have a secondary tech contact.</strong> <p>If you\'d like to add one, please <a href="https://support.mainlib.org/portal/en/newticket" target="_blank">submit a ticket</a>.</p>';
            } else {
            echo '<p><span class="info">Your library\'s <strong>secondary</strong> tech contact is <a href="mailto:' . $tc2email . '">' . $tc2name . '</a>.</span></p>';
            } 
            
            echo $tcDesc;
            ?>
        
        
        </section>
        
        <?php if ($env !== 0) {
              ?>
        <section id="envisionware">
            <h3>Envisionware</h3>
            <p><span class="info">Your library is currently using <strong>Envisionware</strong>. You have <strong><?php echo $clients; ?></strong> client PCs.</span></p>
            <?php echo $envDesc; ?>
            
           
        
            <?php 
            
            $pcresLinks = "<li><a href='https://staff.mainlib.org/knowledge-base/how-to-bypass-the-envisionware-pc-reservation-screen/' target='_blank'>How to Bypass the Envisionware PC Reservation Screen</a></li><li><a href='https://staff.mainlib.org/knowledge-base/understanding-pc-res-log-files/' target='_blank'>Understanding PC Res Logs</a></li><li><a href='https://staff.mainlib.org/knowledge-base/envisionware-pc-usage-statistics/' target='_blank'>Generating PC Usage Statistics with Envisionware</a>";
            $lptLinks = "<li><a href='https://staff.mainlib.org/knowledge-base/envisionware-printing-statistics/' target='_blank'>How to Generate Printing Statistics</a></li>";
            $aamLinks = "<li><a href='https://staff.mainlib.org/knowledge-base/using-aam-with-envisionware/' target='_blank'>Using AAM with Envisionware</a></li>";
            $mpsLinks = "<li><a href='https://staff.mainlib.org/knowledge-base/printing-wirelessly-via-printeron/' target='_blank'>Printing Wirelessly via PrinterOn</a></li><li><a href='https://staff.mainlib.org/knowledge-base/editable-templates/' target='_blank'>Editable PrinterOn Promo Template</a></li>";
            
            
            if ($pcres !== 0) {
                echo "<details><summary>PC Reservation (Time Management)</summary><p>PC Reservation allows you to manage the amount of time your patrons can spend on the public PCs. It allows you to set <strong>time limits</strong> and require users to log in to PCs with their <strong>library card number</strong>.</p>";
                ?>
                                <div class="links">
                    <ul>
                    <?php echo $pcresLinks; ?>
                    </ul>
                    
                </div>
                
                </details>
                <?php
            }
            if ($lpt !== 0) {
                echo "<details><summary>LPT One (Print Management)</summary><p>LPT One allows you to track and manage patron print jobs. Jobs are usually sent to a release station and then released by a staff member or the patron (if you have a print release terminal).";
                
                ?>
                
                                <div class="links">
                    <ul>
                    <?php echo $lptLinks; ?>
                    </ul>
                    
                </div>
                </details>
                
                <?php
            }
            if ($mps !== 0) {
                echo "<details><summary>PrinterOn (Mobile Printing)</summary><p>PrinterOn allows patrons to send <strong>wireless print jobs</strong> via email, a website, or a mobile app - from anywhere in the world! These jobs are usually released from a release station by a staff member or the patron.<br><br>
                
                <div class='info'><strong>Black and White Print Email: </strong><a href='mailto:" . $bwemail . "'>" . $bwemail . "</a><br>";
                echo "<strong>Color Print Email: </strong><a href='mailto:" . $coloremail . "'>" . $coloremail . "</a><br>";
                echo "<strong>Web Portal Address: </strong><a href='" . $webportal . "' target='_blank'>" . $webportal . "</a><br></div>";
                ?>
                <div class="links">
                    <ul>
                    <?php echo $mpsLinks; ?>
                    </ul>
                    
                </div></details>
            
            
            <?php 
            }
            if ($aam !== 0) {
                echo "<details><summary>AAM (Patron Account Balance)</summary><p>AAM allows patrons to store a <strong>cash balance</strong> on their library card. All of the libraries that use AAM share the same database, so patrons can use their balance at any AAM-supported library.";
                
                ?>
                
                                <div class="links">
                    <ul>
                    <?php echo $aamLinks; ?>
                    </ul>
                    
                </div>
                </details>
                <?php
            }
            echo "</ul>";
?>
                <div class="links">
                  <ul>
                      <li><a href="https://staff.mainlib.org/knowledge-base/envisionware-down/" target="_blank">Help! Envisionware is down!</a></li>
        
                      
                  </ul>
                </div>
              </section>
              <?php       }
            ?>
            
              <section id="email">
                <h3>Email</h3>
                <?php 
                $abbr = strtolower($abbr);
                if ($email !== "MAIN") {
                    echo "<p><span class='info'>Your library is not currently using MAIN Gmail for your email usage.</span></p> This means you are most likely either using your own library's Google Workspace account, JerseyConnect, or an internal government email system.</p>
                    <p>Every library uses <strong>one</strong> gmail account each, regardless of whether they use Gmail. This for the circulation accounts.</p>
                    <p><span class='info'>Your library's Gmail circulation account address is: <a href='mailto:circ-" . $abbr . "@mainlib.org'>circ-" . $abbr .  "@mainlib.org</a></span></p>
                    <p>Additionally, a <strong>director alias</strong> is in place which automatically routes all incoming mail to your library email address. Because this is an alias, there is no account to log into directly.</p>
                     <p><span class='info'>Your library's director alias address is: <a href='mailto:dir-" . $abbr . "@mainlib.org'>dir-" . $abbr .  "@mainlib.org</a></span></p>
                    ";
                    

                    echo "<div class='links'><ul><li><a href='https://staff.mainlib.org/knowledge-base/jerseyconnect-faq/' target='_blank'>JerseyConnect FAQ</a></li></ul></div>";
                } else {
                    echo "<p>Your library is currently using MAIN Gmail</p>";
                    echo "<div class='links'><ul><li><a href='https://staff.mainlib.org/knowledge-base/how-to-forward-e-mails-to-another-account-using-gmail/' target='_blank'>How to forward emails to another account</a></li><li><a href='https://staff.mainlib.org/knowledge-base/how-to-create-a-filter-in-gmail/' target='_blank'>How to create an email filter</a></li></ul>";
                }
                ?>
                </section>
                
                <section id="google-drive">
                    <h3>Google Drive</h3>
                    <?php 
                    $googleDriveInfo = "<p><img class='icon' src='/assets/drive-icon.png' align='left'>Google Drive is a cloud storage solution that MAIN currently recommends for backing up important data. Regardless of whether your library uses MAIN Gmail, MAIN offers Google Drive as an option to every location.</p>";
                    $googleDriveLinks = "<div class='links'><ul><li><a href='https://staff.mainlib.org/knowledge-base/how-to-access-files-that-have-been-shared-with-me/' target='_blank'>How to access files that have been shared with me</a></li><li><a href='https://staff.mainlib.org/knowledge-base/how-to-share-a-file-or-folder-on-google-drive/' target='_blank'>How to share a file or folder</a></li><li><a href='https://staff.mainlib.org/knowledge-base/how-to-share-a-link-to-a-file-or-folder/' target='_blank'>How to share a link to a file or folder</a></li><li><a href='https://staff.mainlib.org/knowledge-base/what-are-shared-drives-and-how-do-they-differ-from-my-drive/' target='_blank'>What are Shared Drives and how do they differ from My Drive?</a></li><li><a href='https://staff.mainlib.org/knowledge-base/what-is-drive-file-stream/' target='_blank'>What is Drive for Desktop?</a></li></ul>";
                        
                        if ($drive == 0) {
                            echo "<p><span class='info'>Your library is not using MAIN's Google Drive.</span></p>";
                            echo $googleDriveInfo;
                            
                        } else {
                            echo "<strong>Your library is using MAIN's Google Drive.</strong>";
                            echo $googleDriveInfo;
                            echo $googleDriveLinks;
                        }
                        
                        
                        
                        
                        ?>
                

                </section>
                
                  <section id="stats">
                <h2>Menu & Wifi Statistics</h2>
                <h3>Menu Statistics</h3>
                <?php 
                if ($menu === 0) {
                    echo '<p><span class="info">You are <strong>not</strong> currently getting monthly PC usage (menu page) statistics.</span></p><p>If you\'d like to start, please <a href="https://support.mainlib.org/portal/en/newticket" target="_blank">open a ticket</a>.</p>';
                } else {
                    
                    echo '<p><span class="info">You are currently getting monthly PC usage (menu page) statistics.</span></p><p> Every month, the report is sent to your library\'s circulation account: <a href="mailto:circ-' . $abbr . '@mainlib.org">circ-' . $abbr . '@mainlib.org</a></p>';
                }
                echo "<h3>Wifi Statistics</h3>";
                if ($wifi === 0) {
                    echo '<p><span class="info">You are not currently getting monthly wifi usage statistics.</span></p><p>If you\'d like to start, please <a href="https://support.mainlib.org/portal/en/newticket" target="_blank">open a ticket</a>.</p>';
                } else {
                    echo '<p><span class="info">You are currently getting wifi usage (splash page) statistics.</span></p>
                        <p>These statistics are requested by the state at the end of the year. If you\'re interested in starting to collect them, please <a href="https://support.mainlib.org/portal/en/newticket" target="_blank">open a ticket</a>.</p>';
                }
                
                ?>
                </div>
                
                
                <div class="links">
                    <ul>
                        <li><a href="https://staff.mainlib.org/pc-usage-and-web-statistics/" target="_blank">View Menu and Wifi Statistics</a></li>
                        <li><a href="https://staff.mainlib.org/knowledge-base/monthly-pc-statistics-menu-page/" target="_blank">What is the menu page and how does it generate statistics?</a></li>
                        <li><a href="https://staff.mainlib.org/knowledge-base/how-does-main-generate-wifi-statistics-for-your-library/" target="_blank">How does MAIN generate wifi statistics for your library?</a></li>
                    </ul>
                </div>
        </section>
                <section id="aspen">
                    <h2>Aspen Discovery</h2>
                    <p>Aspen is MAIN’s library discovery layer, which replaces the default catalog of our Polaris ILS.  Its cornerstones are the capability for each library to customize their own Aspen site as well as the ability to search, interact with, & promote content from within not only our Polaris database, but also external content from both system-wide & library specific services, including eContent, programming, special collections, genealogy, etc.</p>
                    <p>Administrative permissions in Aspen may be requested via Support Ticket by the Library Director.</p>
                    <p><span class="info">Your library's Aspen URL is <a href='<?php echo $aspenurl; ?>'><?php echo $aspenurl; ?></a></span></p>
                    <p>Aspen is the discovery layer that sits on top of your library catalog.</p>
                    <div class="links">
                        <ul>
                            <li><a href="https://staff.mainlib.org/aspen-hq/" target="_blank">Aspen HQ</a></li>
                        </ul>
                    </div>
                </section>
                <section id="magellan">
     
                <h2>Magellan</h2>
                <!--<img src="/assets/MAIN-Magellan.gif">-->
               <?echo $magDesc; ?>
                <ul>
                    <li><span class="info"><strong>Magellan Login:</strong> <a href="https://mainlib.org/wp-admin/" target="_blank">https://mainlib.org/wp-admin/</a></span></li>
                    <li><span class="info"><strong>Library Username: </strong> <?php echo $maguser; ?></span></li> 
                    <li><span class="info"><strong>Library Password: </strong> <?php echo $magpass; ?></span></li>
                </ul>
                    <div class="saveThis">
                        <p>Please save this information somewhere you can easily retrieve it.</p>
                    </div>
                    <div class="links">
                        <ul>
                            <li><a href="https://staff.mainlib.org/magellan-hq/" target="_blank">Magellan HQ</a></li>
                            <li>
                                <a href="https://staff.mainlib.org/knowledge-base/making-changes-to-magellan/" target="_blank">How to change library contact info on Magellan</a>
                                </li>
                        </ul>
                    </div>
                </section>
                
                <section id="mobileapp">
                    <h2>Mobile App</h2>
                    <p>MAIN has a consortium-wide mobile app developed by <a href="https://wp.sol.us/our-company/" target="_blank">Solus</a>. While the initial look of the “MAIN Libraries (NJ)” app will be MAIN branded, upon logging in, patrons can see any branding/customizations applied by their library. The app provides for catalog search, item requests, account maintenance, library info, website/resource links, and optional features like self-check & curbside pickup.</p>
                    <p>Each location has a set of credentials for the <strong>MAIN Mobile App</strong>. By logging in, you can modify the hours of your library among other settings.</p>
                    <ul>
                        <li><span class="info"><strong>Mobile App Login: <a href="https://admin-iius1.sol.us/" target="_blank">https://admin-iius1.sol.us/</a></strong></span></li>
                        <li><span class="info"><strong>Username:</strong> <?php echo $mobileuser; ?></span></li>
                        <li><span class="info"><strong>Password:</strong> <?php echo $mobilepass; ?></span></li>
                        
                    </ul>
                    <div class="links">
                        <ul>
                            <li><a href="https://staff.mainlib.org/mobile-app-hq/" target="_blank">Mobile App HQ</a></li>
                            <li><a href="https://staff.mainlib.org/knowledge-base/how-to-change-your-hours-on-the-main-mobile-app/" target="_blank">How to change hours on the Mobile App</a></li>
                            
                            </ul>
                    </div>
                </section>
        
        <section id="closings">
            <h2>Unexpected Closings</h2>
            <p>When you need to close your library due to inclement weather, renovations or other unexpected events, you can submit your closings to our <a href="https://mainlib.org/closings/" target="_blank">Emergency Closings Tool</a> which can also be found on the Staff website homepage.</p>
            <p><span class="info">Both the username and the password is <strong>dementors</strong></span>.</p>
            <p>Submitting your closing here will add an alert to the MAIN homepage and the library catalog alerting patrons to your closure. Please do not use this functionality for closings that are scheduled to last more than a week. If, for example, your library will be closed for a significant construction project, please open a ticket and the MAIN office can better help support your library.</p>
            <div class="links">
            <ul>
                <li><a href="https://mainlib.org/closings/" target="_blank">Emergency Closing Tool</a></li>
                <li><a href="https://staff.mainlib.org/knowledge-base/submit-an-emergency-closing/" target="_blank">How to Submit an Unexpected Closing</a></li>
            </ul>
            </div>
        </section>
        </main>
        <div class="right-sidebar">
                        
                        <ul>
                            <h2>Quick Links</h2>
                            <li><a href="#main-university">MAIN University</a></li>
                            <li><a href="#group-purchase">Group Purchase</a></li>
                            
                            <?php if (file_exists($networkDiagram)) {?>
                            <li><a href="#network">Network</a></li>
                            <?php } ?>
                            <li><a href="#tech-contacts">Tech Contacts</a></li>
                            <?php if ($env !== 0) { ?>
                            <li><a href="#envisionware">Envisionware</a></li>
                            <?php } ?>
                            <li><a href="#email">Email</a></li>
                            <li><a href="#google-drive">Google Drive</a></li>
                            <li><a href="#stats">Menu & Wifi Statistics</a></li>
                            <li><a href="#aspen">Aspen Discovery</a></li>
                            <li><a href="#magellan">Magellan</a></li>
                            <li><a href="#mobileapp">Mobile App</a></li>
                            
                            <li><a href="#closings">Closings</a></li>
                        </ul>
                    </div>
    <style>
        h1, h2, h3, p, ul, h3 > p, .img {
    max-width:900px;
    margin:0 auto;
    margin-bottom:20px;
    margin-top:20px;
}

.portalContainer {
    max-width:1600px;
}

    </style>
        
    <?php
}
?>