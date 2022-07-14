<?php

include "../../config.php";

if (isset($_POST['submitEcontent'])) {
    $id = $_POST['libid']; // this needs to be library ID
    $abbr = $_POST['abbr'];
    $allContent = array(
        // blank array to hold db stuff
        'db' => array(),
        // this is an array of the chosen checkbox ids
        'new' => $_POST['econtent'],
        );
        
        
       echo print_r($_POST['econtent']) . "<br>";
    $newArray = array_map('strval', $_POST['econtent']);
    echo print_r($newArray) . "<br>";
    // query
    // we are selecting all of the options here from the econtentlist that matches the chosen library
    // so I guess the [db] list is the items the library has already selected
    $stmt = $con->prepare("SELECT id, econtent_id FROM econtentlist WHERE library_id = " . $id);
	$stmt->execute();
    $result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
	    // pushin it on over to the array, so now the db array has all of the new items
	    array_push($allContent['db'], $row['econtent_id']);
	    echo "test";
	}
	
	// checking the length of the arrays I guess
	$db_length = count($allContent['db']);
	$new_length = count($allContent['new']);
	
	//echo "db length" . $db_length . "<br>";
	//echo "new length" . $new_length . "<br>";
	//echo "db " . print_r($allContent['db']) . "<br>";
	//echo "new " . print_r($allContent['new']) . "<br>";
	
	  /* Compare the new ($tags['new']) and existing ($tags['db']) tag arrays, removing duplicates  */
      for ($n=0; $n < $new_length; $n++) {
        for ($d=0; $d < $db_length; $d++) :
            // this is never being met
          if ($allContent['new'][$n] == $allContent['db'][$d]) {
            // unset destroys the variables, which I guess is what isn't happening rn
            unset($allContent['new'][$n]);
            echo "unsetting new <br>";
            unset($allContent['db'][$d]);
            echo "unsetting db <br>";
          } else {
            // if allcontent['new']
            echo "allContentNew: " . $allContent['new'][$n] . "<br>";
            echo "allContentDb: " . $allContent['db'][$d] . "<br>";
          }
        endfor;
      }

        
  /* fix array indices so we can use for loops below */
  // array_values returns the values from the array
      $allContent['new'] = array_values($allContent['new']);
      $allContent['db'] = array_values($allContent['db']);
      
    echo "post dupe db " . print_r(array_values($allContent['db'])) . "<br>";
	echo "post dupe new " . print_r(array_values($allContent['new'])) . "<br>";
      
      /* add newly checked items */
  for ($i=0; $i < count($allContent['new']); $i++) {
      // query
    $stmt = $con->prepare("INSERT INTO econtentlist (econtent_id, library_id) VALUES (?,?)");
    $stmt->bind_param("ss", $allContent['new'][$i], $id);
    $stmt->execute();
    echo "adding item " . $allContent['new'][$i] . "<br>";
    $result = $stmt->get_result();
    $stmt->close();
  }
  
    /* remove exisitng tags that we unchecked */
  for ($i=0; $i < count($allContent['db']); $i++) {
      
      
    $stmt = $con->prepare("DELETE FROM econtentlist WHERE econtent_id = ? AND library_id = ?");
    //echo "<br>allContent is " . $allContent['db'][$i] . "<br>";
    $stmt->bind_param("ss", $allContent['db'][$i], $id);
    $stmt->execute();
    if (!$stmt->execute()) {
    //echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
    $stmt->close();
    // deletes by econtent_id
    echo "deleting item " . $allContent['db'][$i] . "<br>";
  }

 header('location: library.php?libraries=' . $abbr . '&view=Submit');
}