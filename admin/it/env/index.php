<?php 
include "../../../auth.php";
include "../../../adminOnly.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ENV Console Data</title>
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
<h1>Envisionware Console Data</h1>
<table>
            <thead>
                <th>Library</th>
                <th>Model</th>
                <th>OS</th>
                <th>SVC Tag</th>
                <th>IP</th>
                <th>Acronis</th>
                <th class="xsm">LPTA</th>
                <th class="xsm">JQE</th>
                <th class="xsm">PS</th>
                <th class="xsm">PDS</th>
                <th class="xsm">PCRMC</th>
                <th class="xsm">SM</th>
                
                <th class="edit">Edit</th>
            </thead>
            <tbody>

<?php
            include "../../../config.php";
            $stmt = $con->prepare("SELECT libraries.id, libraries.library_name, libraries.library_abbr, envisionware.con_model, envisionware.con_svc_tag, envisionware.con_os, envisionware.con_ip, envisionware.con_acronis, envisionware.v_LPTA, envisionware.v_JQE, envisionware.v_PS, envisionware.v_PDS, envisionware.v_PCRMC, envisionware.v_SM FROM libraries JOIN envisionware ON libraries.id = envisionware.library_id WHERE envisionware.envisionware = 1");
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
        	    $conmodel = $row['con_model'];
        	    $conos = $row['con_os'];
        	    $conip = $row['con_ip'];
        	    $consvctag = $row['con_svc_tag'];
        	    $conacronis = $row['con_acronis'];
        	    $lpta = $row['v_LPTA'];
        	    $jqe = $row['v_JQE'];
        	    $ps = $row['v_PS'];
        	    $pds = $row['v_PDS'];
        	    $pcrmc = $row['v_PCRMC'];
        	    $sm = $row['v_SM'];
                ?>
                
                                
                <tr id="<?php echo $id; ?>">
                    
                    <td><?php echo $abbr; ?></td>
                    <td><?php echo $conmodel; ?></td>
                    <td><?php echo $conos;
                    
                    
                    ?></td>
                    <td><?php echo $consvctag; ?></td>
                    <td><?php echo $conip; ?></td>
                    <td><?php echo $conacronis; ?></td>
                    <td><?php echo $lpta; ?></td>
                    <td><?php echo $jqe; ?></td>
                    <td><?php echo $ps; ?></td>
                    <td><?php echo $pds; ?></td>
                    <td><?php echo $pcrmc; ?></td>
                    <td><?php echo $sm; ?></td>
                    <td class="edit"><input type='submit' class='editBtn' name='editENV' value='Edit'></td>
                    
                    
                </tr>

                
                <?php
	           
        	}
                if (isset($_POST['editENV'])) {
                ?>
        	<input type='submit' name='submitENV' class='editBtn' value='Save'>
        	<?php
                
        	$stmt->close();
                }
        	
	    ?>
	    </form>

        </div>
        <style>
                td {
        max-width:100px;
        word-break:break-word;
    }
    .portalContainer {
        max-width:1600px;
    }
        </style>
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
                   if (i !== 0) {
               $(this).html('<input type="text" class=' + i + ' value="' + dataArr[i] + '">');
                   }
               console.log(dataArr[i]);
               i++;
               } else {
                   $(this).html('<input type="hidden" name="id" value="' + id + '"><input type="submit" id="saveBtn" name="envSubmit" value="Submit">')
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
    			    'id': myData[12],
    			    'model':myData[1],
    			    'os':myData[2],
    			    'svc':myData[3],
    			    'ip':myData[4],
    			    'acronis':myData[5],
    			    'lpta':myData[6],
    			    'jqe':myData[7],
    			    'ps':myData[8],
    			    'pds':myData[9],
    			    'pcrmc':myData[10],
    			    'sm':myData[11]
    			    
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


