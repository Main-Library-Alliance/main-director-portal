<?php 
include "../../../auth.php";
include "../../../adminOnly.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IP Addresses</title>
        <link rel="stylesheet" href="../../../assets/css/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
        <script src="../../../assets/scripts/editTable.js"></script>
  
    </head>
        <body>
            <div class="portalContainer">
            <?php include "../../../portal/header.php"; ?>
                <div class="flex">
                <?php include "../../../portal/sidebar.php"; ?>
                    <main>
                        <h1>IP Addresses</h1>
                        <form action="export.php" method="post">
                        
                        <input type="submit" class="btn" value="Export">
                        </form>
                        <table>
                            <thead>
                                <th>Library</th>
                                <th>IP 1</th>
                                <th>IP 2</th>
                                <th class="edit">Edit</th>
                            </thead>
                            <tbody>
    
                            <?php
                            include "../../../config.php";
                            $stmt = $con->prepare("SELECT libraries.id, libraries.library_name, libraries.library_abbr, ip_addresses.ip_addr_1, ip_addresses.ip_addr_2 FROM libraries JOIN ip_addresses ON libraries.id = ip_addresses.library_id ORDER BY libraries.library_name ASC");
                        	$stmt->execute();
                            $result = $stmt->get_result();
                            if (!isset ($_POST['editTC'])) {
                               echo "<form method='POST' action='index.php'>
                               
                               ";
                            } else {
                               //echo "<form method='POST' action='submit.php'>";
                            }
                        	while ($row = $result->fetch_assoc()) {
                        	    $id = $row['id'];
                        	    $name = $row['library_name'];
                        	    $ip1 = $row['ip_addr_1'];
                        	    $ip2 = $row['ip_addr_2'];
                                ?>
                    
                                    
                                <tr id="<?php echo $id; ?>">
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $ip1; ?></td>
                                    <td><?php echo $ip2; ?></td>
                                    <td class="edit"><input type='submit' class='editBtn' name='editDF' value='Edit'></td>
                                </tr>
    
                    
                                <?php
                        	        }
            	                $stmt->close();
    	                        ?>
                                </table>
                            </main>
                        </div>
                    </body>
                <script>
            $(function() {
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
                    id = $('#libID').val();
                    console.log(myData[1]);
                        $.ajax({
            			type: 'post',
            			data: {
            			    'id':id, 
            			    'ip1':myData[1],
            			    'ip2':myData[2]
            			    
            			},
            			url: 'submit.php',
            			success: function(response) {
            			    console.log(id, myData[1], myData[2]);
            				window.location=window.location;
            			}
            		});
                })
                
            });
        </script>
    
    </html>
    
    
