<?php 
include "../../../auth.php";
include "../../../adminOnly.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MAIN Portal</title>
        <link rel="stylesheet" href="../../../assets/css/style.css">
        <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="portalContainer">
            <?php include "../../../portal/header.php"; ?>
            <div class="flex">
                <?php include "../../../portal/sidebar.php"; ?>
            <main>
<h1>MAIN Technology Contacts</h1>
<table>
            <thead>
                <th>Library</th>
                <th>TC Name</th>
                <th>TC Email</th>
                <th>TC2 Name</th>
                <th>TC2 Email</th>
                <th class="edit sm">Edit</th>
            </thead>
            <tbody>

<?php
            include "../../../config.php";
            $stmt = $con->prepare("SELECT technical_contacts.id, library_name, library_abbr, technical_contacts.tech_contact_one_name, technical_contacts.tech_contact_one_email, technical_contacts.tech_contact_two_name, technical_contacts.tech_contact_two_email FROM libraries JOIN technical_contacts ON libraries.id = technical_contacts.library_id");
        	$stmt->execute();
            $result = $stmt->get_result();
            //if (!isset ($_POST['editTC'])) {
              // echo "<form method='POST' action='index.php'>
              // <input type='submit' name='editTC' value='Edit'>
            //   ";
            //} else {
           //    echo "<form method='POST' action='submit.php'>
               
            //   ";
           // }
        	while ($row = $result->fetch_assoc()) {
        	    $id = $row['id'];
        	    $name = $row['library_name'];
        	    $tc1name = $row['tech_contact_one_name'];
                $tc2name = $row['tech_contact_two_name'];
                $tc1email = $row['tech_contact_one_email'];
                $tc2email = $row['tech_contact_two_email'];
                ?>
                
                                
                <tr id="<?php echo $id; ?>">
                    
                    <td><?php echo $name; ?></td>
                    <td><?php echo $tc1name; ?></td>
                    <td><?php echo $tc1email; ?></td>
                    <td><?php echo $tc2name; ?></td>
                    <td><?php echo $tc2email; ?></td>
                    <td class="edit"><input type='submit' class='editBtn' name='editTC' value='Edit'></td>
                    
                    
                </tr>

                
                <?php
	           
        	}
                if (isset($_POST['editTC'])) {
                ?>
        	<input type='submit' name='submitTC' class='editBtn' value='Save'>
        	<?php
                
        	$stmt->close();
                }
        	
        	if (isset($_POST['submitTC'])) {
        	    $id = $_POST['id'];
        	    $tc1name = $_POST['tc1name'];
        	    $tc1email = $_POST['tc1email'];
        	    $tc2name = $_POST['tc2name'];
        	    $tc2email = $_POST['tc2email'];
        	    $stmt = $con->prepare("UPDATE technical_contacts SET tech_contact_one_name = ?, tech_contact_one_email = ? , tech_contact_two_name = ?, tech_contact_two_email = ? WHERE id = ?");
        	    $stmt->bind_param("sssss", $tc1name, $tc1email, $tc2name, $tc2email, $id);
        	    $stmt->execute();
        	}
	    ?>
	    </form>

        </div>
    </body>
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
               dataArr.push($(this).text());
            });

            
            // then we loop through again
            i = 0; // using this to keep track
            $($(this).parent('td').parent('tr').children()).each(function() {
               //console.log($(this).text();
               
               
               if ($(this).attr('class') !== "edit") {
                if (i !==0) {
               $(this).html('<input type="text" class=' + i + ' value="' + dataArr[i] + '">');
                }
               console.log(dataArr[i]);
               i++;
               } else {
                   $(this).html('<input type="hidden" name="id" value="' + id + '"><input type="submit" id="saveBtn" name="tcSubmit" value="Submit">')
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
                //console.log($(this).children('input').val());
            });
            console.log(myData);
                $.ajax({
    			type: 'post',
    			data: {
    			    'id':myData[5], 
    			    'tc1name':myData[1], 
    			    'tc1email':myData[2], 
    			    'tc2name':myData[3], 
    			    'tc2email':myData[4]
    			    
    			},
    			url: 'submit.php',
    			success: function(response) {
    				location.reload();
    			}
    		});
        })
        
    });
    </script>
<style>
    td {
        max-width:200px;
        word-break:break-word;
    }
    .portalContainer {
        max-width:1600px;
    }
</style>
</html>


