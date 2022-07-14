
<?php 
include "../../auth.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MAIN eContent GP Overview</title>
        <link rel="stylesheet" href="../../../assets/css/style.css">
        
        
    </head>
    <body>
        <div class="portalContainer">
            <?php include "../../header.php"; ?>
            <div class="flex">
                <?php include "../../portal/sidebar.php"; ?>
            <main>
            <h1>eContent Group Purchase Overview</h1>

<?php
            include "../../config.php";
        	
          ?>
          <table>
              <thead>
                  <th>Library</th>
                  <?php
                   $factsOnFile = [];
                   $myHeritage = [];
                   $brainFuseJobNow = [];
                   $brainFuseVetNow = [];
                   $pressReader = [];
                   $tumbleMath = [];
                  $stmt = $con->prepare("SELECT * FROM econtent ORDER BY name ASC");
        	$stmt->execute();
            $result = $stmt->get_result();
        	while ($row = $result->fetch_assoc()) {
        	    $id = $row['id'];
        	    $name = $row['name'];
        	    echo "<th>" . $name . "</th>";
        	    
           
                $stmt2 = $con->prepare("SELECT * FROM econtentlist WHERE econtent_id =" . $id);
            	$stmt2->execute();
                $result2 = $stmt2->get_result();
            	while ($row2 = $result2->fetch_assoc()) {
            	    $library_id = $row2['library_id'];
            	    $content_id = $row2['econtent_id'];
            	    
            	    if ($id == 1) {
            	        $factsOnFile[] = $library_id;
            	    } else if ($id == 2) {
            	        $myHeritage[] = $library_id;
            	    } else if ($id == 3) {
            	        $brainFuseJobNow[] = $library_id;
            	    } else if ($id == 4) {
            	        $brainFuseVetNow[] = $library_id;
            	    } else if ($id == 5) {
            	        $pressReader[] = $library_id;
            	    } else if ($id == 6) {
            	        $tumbleMath[] = $library_id;
            	    }
            	}
        	}
            //print_r($factsonFile);
        	?>
        	
        	
              </thead>
              <tbody>
          <?php
           //print_r($factsOnFile);
            $stmt = $con->prepare("SELECT * FROM libraries");
        	$stmt->execute();
            $result = $stmt->get_result();
        	while ($row = $result->fetch_assoc()) {
        	    $id = $row['id'];
        	  
        		$name = $row['library_name'];
        		echo "<tr>";
        		echo "<td>" . $name . "</td>";
        			        		echo "<td>";
        		if (in_array($id, $brainFuseJobNow)) {
        		    echo "x";
        		}
        		        		echo "<td>";
        		if (in_array($id, $brainFuseVetNow)) {
        		    echo "x";
        		}
        		echo "</td>";
        		echo "<td>";
        		
        		if (in_array($id, $factsOnFile)) {
        		    echo "x";
        		}
        		echo "</td>";
        		echo "<td>";
        		if (in_array($id, $myHeritage)) {
        		    echo "x";
        		}
        		echo "</td>";
        	
        		        		echo "<td>";
        		if (in_array($id, $pressReader)) {
        		    echo "x";
        		}
        		echo "</td>";
        		        		echo "<td>";
        		if (in_array($id, $tumbleMath)) {
        		    echo "x";
        		}
        		echo "</td>";
        		echo "</td>";
        		echo "</td>";
        		echo "</td>";
        		echo "</tr>";
    
        	}
        	$stmt->close();
        
?>
</table>