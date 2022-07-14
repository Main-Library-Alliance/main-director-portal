<?php 
include "../../../auth.php";
include "../../../adminOnly.php";
include "../../../config.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MAIN Mobile App</title>
        <link rel="stylesheet" href="../../../assets/css/style.css">
        <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
        
    </head>
    <body>
        <div class="portalContainer">
            <?php include "../../../portal/header.php"; 
            ?>
            <div class="flex">
                <?php include "../../../portal/sidebar.php"; ?>
                <main>
                <h1>Mobile App Configuration</h1>
                <p>When editing the yes/no fields, <strong>0 = no</strong> and <strong>1 = yes</strong></p>

          <table>
              <thead>
                  <th>Library</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Self Check</th>
                  <th>Click Collect</th>
                  <th class="edit">Edit</th>
        
              </thead>
              <tbody>
          <?php
          
            $stmt = $con->prepare("SELECT libraries.id, library_name, mobile_app.username, mobile_app.password, mobile_app.self_check, mobile_app.click_collect FROM libraries JOIN mobile_app ON libraries.id = mobile_app.library_id");
        	$stmt->execute();
        	//echo $id;
            $result = $stmt->get_result();
        	while ($row = $result->fetch_assoc()) {
        	    $id = $row['id'];
        	    $name = $row['library_name'];
        	    $username = $row['username'];
        	    $password = $row['password'];
        	    $self = $row['self_check'];
        	    $click = $row['click_collect'];
        	  
        		echo "<tr id='" . $id . "'>";
        		echo "<td>" . $name . "</td>";
        		echo "<td>";
        		
        		echo $username;
        		echo "</td>";
        		echo "<td>";
        	    echo $password;
        		echo "</td>";
        		echo "<td class='sm'>";
        		if ($self == 1) {
        		    echo "x";
        		}
        		echo "</td>";
        		echo "<td class='sm'>";
        		if ($click == 1) {
        		    echo "x";
        		}
        		echo "</td>";
        		echo "<td class='edit'><input type='submit' class='editBtn' name='editMA' value='Edit'></td>";
        		echo "</tr>";
    
        	}
        	$stmt->close();
        
?>
</table>

    <script>
    
    $(function() {
    // I finally figured out how to nicely and easily repopulate an 'edit view' with JS, from a php database (at least in a table form).
        $('.editBtn').on("click", function(e) {
            $('.editBtn').css("display", "none");
            e.preventDefault();
            

            // grab the ID of the row being edited
            var id = $(this).parent('td').parent('tr').attr('id');
            
            // this nicely grabs the existing text inside the cells
            // so we wanna hold onto this and add it to an array
            var dataArr = [];
            $($(this).parent('td').parent('tr').children()).each(function() {
               //console.log($(this).text().trim());
               var item = $(this).text();
               if (item === '') {
                   item = '0';
               } else if (item === 'x') {
                   item = '1';
               }
               dataArr.push(item);
            });

            
            // then we loop through again
            i = 0; // using this to keep track
            $($(this).parent('td').parent('tr').children()).each(function() {
               //console.log($(this).text();
               
               
               if ($(this).attr('class') !== "edit") {
                   if (i !== 0) {
               $(this).html('<input type="text" class=' + i + ' value="' + dataArr[i] + '">');
                   }
               console.log(dataArr[i]);
               i++;
               } else {
                   
                   $(this).html('<input type="hidden" name="id" id="libID" value="' + id + '"><input type="submit" id="saveBtn" name="maSubmit" value="Submit">')
               }
               //dataArr.push($(this).text().trim());
            });
            
            
            
            console.log(dataArr);
        });
        
        $('.edit').on("click", "#saveBtn", function() {
            // this is the function that sends the data to the database
            // so first we must grab the new inputs:
            var id = $(this).parent('td').parent('tr').attr('id');
            
            // loop through all inputs, store them in array:
            var myData = [];
            $($(this).parent('td').parent('tr').children()).each(function() {
                // each input's value to array
                myData.push($(this).children('input').val());
                console.log($(this).children('input').val());
            });
            id = $('#libID').val();
            console.log(myData[1]);
                $.ajax({
    			type: 'post',
    			data: {
    			    'id':id,
    			    'username':myData[1],
    			    'password':myData[2],
    			    'selfCheck':myData[3],
    			    'clickCollect':myData[4]
    			},
    			url: 'submit.php',
    			success: function(response) {
    			    location.reload();
    			    
    			}
    		});
        })
        
    });
    </script>