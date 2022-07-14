<?php 
include "../../../auth.php";
include "../../../adminOnly.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inventory</title>
        <link rel="stylesheet" href="../../../assets/css/style.css">
        <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
        <script src "../../../assets/scripts/editTable.js"></script>
    </head>
    <body>
        <div class="portalContainer">
            <?php include "../../../header.php"; ?>
            <div class="flex">
                <?php include "../../../portal/sidebar.php"; ?>
                <main>
<h1>Inventory</h1>
<table>
            <thead>
                <th>Date</th>
                <th>Library</th>
                <th>Item</th>
                <th>Serial #</th>
                <th>Price</th>
                <th>Vendor</th>
                <th>PO #</th>
                <th class="edit">Edit</th>
            </thead>
            <tbody>

<?php
            include "../../../config.php";
            $stmt = $con->prepare("SELECT libraries.id, libraries.library_name, libraries.library_abbr, inventory.date, inventory.item_purchased, inventory.serial_no, inventory.vendor, inventory.po_number, inventory.unit_price FROM libraries JOIN inventory ON libraries.id = inventory.library_id ORDER BY inventory.date DESC");
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
        	    $abbr = $row['library_abbr'];
        	    $name = $row['library_name'];
        	    $date = $row['date'];
        	    $item = $row['item_purchased'];
        	    $serial = $row['serial_no'];
        	    $price = $row['unit_price'];
        	    $vendor = $row['vendor'];
        	    $po = $row['po_number'];
                ?>
                
                                
                <tr id="<?php echo $id; ?>">
                    
                    <td><?php echo $date; ?></td>
                    <td><?php echo $abbr; ?></td>
                    
                    <td><?php echo $item; ?></td>
                    <td><?php echo $serial; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $vendor; ?></td>
                    <td><?php echo $po; ?></td>
                    <td class="edit"><input type='submit' class='editBtn' name='editDF' value='Edit'></td>
                    
                    
                </tr>

                
                <?php
	           
        	}
                if (isset($_POST['editDF'])) {
                ?>
        	<?php
                
        	$stmt->close();
                }
        	

	    ?>
	    </form>

        </div>
    </body>
    <script>
    
    $(function() {
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
                   
                if (i !== 0) {
               $(this).html('<input type="text" class="field" value="' + dataArr[i] + '">');
                }
               console.log(dataArr[i]);
               i++;
               } else {
                   $(this).html('<input type="hidden" name="id" id="libID" value="' + id + '"><input type="submit" id="saveBtn" name="tcSubmit" value="Submit">')
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
            console.log(myData[1]);
                $.ajax({
    			type: 'post',
    			data: {
    			    'id':myData[2], 
    			    'licensecount':myData[1], 
    			    
    			},
    			url: 'submit.php',
    			success: function(response) {
    				location.reload();
    			}
    		});
        })
        
    });
    </script>

</html>


