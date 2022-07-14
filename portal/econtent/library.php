<?php 
include "../../auth.php";

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>eContent Group Purchase</title>
        <link rel="stylesheet" href="../../assets/css/style.css">
        
    </head>
    
        <body>
                <div class="portalContainer">
                <?php include "../../header.php"; ?>
                    <div class="flex">
                        <?php include "../../portal/sidebar.php"; ?>
                        <main>
                            <h1>eContent Group Purchase</h1>
                    
                            <?php
                      
                        
                            $username = $_SESSION["username"];
                            
                             if ($username == "maintech") {
                                            
                                if (isset($_GET['libraries'])) {
                                    $abbr = $_GET['libraries'];
                                    
                                }
                               
                            
                            } else {
                                // if not logged in as maintech, the username will always be the library abbreviation
                                $abbr = $username;
                            }
                            include "../../config.php";
                           
                            // initial check for authentication
                            $stmt = $con->prepare("SELECT * FROM libraries WHERE library_abbr = ?");
                            $stmt->bind_param("s", $abbr);
                	        $stmt->execute();
                            $result = $stmt->get_result();
                            
                            
                             if ($username == "maintech") {
                                 echo 'You are viewing <strong>' . $abbr . '</strong>.';
                                 
                             }
                            ?>
                            
                            <p>This page displays all of the different eContent products/providers with which MAIN has negotiated discounts. Libraries may choose to opt in or out of subscriptions each calendar year. Subscriptions usually begin every January 1st.</p>
                            <p>If a checkmark appears next to one or more of these products/providers, then your library currently pays a discounted rate for your patrons to have access to the product/provider. The MAIN office sends a separate invoice for these products/providers to your library since they are not covered as part of the annual MAIN assessment.</p>
                            
            <?php
	        while ($row = $result->fetch_assoc()) {
	            
	            $libid = $row['id'];
	           
	            $name = $row['library_name'];
	            
    	        $abbrev = strtolower($row['library_abbr']);
    	        
    	        
    	         //echo "You are logged in as... <strong>" . $name . "</strong>";
    	         //echo "<br><br>";
    	         
                
                $econtent_ids = array();
    	         $stmt = $con->prepare("SELECT econtent_id, econtent.name FROM econtentlist JOIN econtent ON econtentlist.econtent_id = econtent.id WHERE library_id = ? ORDER BY econtent.name ASC");
    	         $stmt->bind_param("s", $libid);
    	         $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    // pushes econtent ids to array
                    array_push($econtent_ids, $row['econtent_id']);
                }
	        }
                // $get_all_tags / econtent
                $stmt = $con->prepare("SELECT * FROM econtent");
            	$stmt->execute();
                $result = $stmt->get_result();
            	while ($row = $result->fetch_assoc()) { ?>
            	 <div>
            	     <form method="POST" action="submit.php">
                      <input type="checkbox" name="econtent[]" value="<?php echo $row['id']; ?>"
            	<?php
            		/* here, we loop through all of the site's existing tags */
                        for ($i=0; $i < count($econtent_ids); $i++) {
                          /* if any of the site's existing tags match the one currently stored in $single_tag, we echo "checked" so our checkboxes match the database  */
                          if ($row['id'] === $econtent_ids[$i]) { 
                              echo "checked"; 
                          }
 
                              
                          } ?>
                          <label for="<?php echo $id . "-" . $row['name']; ?>"><?php echo $row['name']; ?></label>
                          <?php
            	       }
            	       ?>
            	       <br>
            	       <input type="hidden" name="libid" value="<?php echo $libid; ?>">
            	       <input type="hidden" name="abbr" value="<?php echo $abbr; ?>">
            	       
            	       <?php 
            	       if ($username == "maintech") { ?>
            	       <input type="submit" name="submitEcontent" value="submit">
            	      <?php }?>
            	       
            	       </form>
            	       
            	       <p>To see a full list of which libraries subscribe to which of the above products/providers, click <a href="view.php">here</a>.</p>
            	       <?php
            	$stmt->close();


        
    

 
	