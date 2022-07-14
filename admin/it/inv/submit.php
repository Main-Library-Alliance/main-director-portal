<?php 
include "../../../auth.php";
include "../../../adminOnly.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Deep Freeze Licenses</title>
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
                <h1>Add Group Order Inventory</h1>
                
                <table>
                    
                    <tbody>
                        <form>
                            <tr>
                                <td>
                                    <label>Date:</label>
                                </td>
                                <td>
                                    <input type="date">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Library:</label>
                                </td>
                                

                                <td>
                                 <select>
                                     <option></option>
                                <?php 
                                include "../../../config.php";
                                $stmt = $con->prepare("SELECT * FROM libraries");
                            	$stmt->execute();
                                $result = $stmt->get_result();
                            	while ($row = $result->fetch_assoc()) {
                            	    $libname = $row['library_name'];
                            	   
                            	    echo "<option value='" . $libname . "'>" .  $libname . "</option>";
                            	}
                            	$stmt->close();
                                ?>
                                </select>
                            
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                            <label>Item Purchased:</label></td>
                            <td><select>
                                
                                <option></option>
                                
                                <?php 
                                $stmt = $con->prepare("SELECT DISTINCT item_purchased FROM inventory ORDER BY item_purchased ASC");
                            	$stmt->execute();
                                $result = $stmt->get_result();
                            	while ($row = $result->fetch_assoc()) {
                            	    $item = $row['item_purchased'];
                            	   
                            	    echo "<option value='" . $item . "'>" .  $item . "</option>";
                            	}
                            	$stmt->close();
                                ?>
                                
                                
                                </select></td>
                            </tr>
                            <tr>
                                <td>
                            <label>Serial Number:</label></td>
                            <td>
                                <select>
                                    <option></option>
                               
                                <?php
                                
                                 $stmt = $con->prepare("SELECT DISTINCT serial_no FROM inventory ORDER BY serial_no ASC");
                            	$stmt->execute();
                                $result = $stmt->get_result();
                            	while ($row = $result->fetch_assoc()) {
                            	    $serial = $row['serial_no'];
                            	   
                            	    echo "<option value='" . $serial . "'>" .  $serial . "</option>";
                            	}
                            	$stmt->close();
                            	
                            	?>
                            	</select>
                            </td>
                            </tr>
                            <tr>
                                <td>
                            <label>Unit Price:</label></td>
                            <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td>
                            <label>Vendor:</label></td>
                            <td><select><option></option>
                            
                            <?php 
                                $stmt = $con->prepare("SELECT DISTINCT vendor FROM inventory ORDER BY vendor ASC");
                            	$stmt->execute();
                                $result = $stmt->get_result();
                            	while ($row = $result->fetch_assoc()) {
                            	    $vendor = $row['vendor'];
                            	   
                            	    echo "<option value='" . $vendor . "'>" .  $vendor . "</option>";
                            	}
                            	$stmt->close();
                                ?>
                            
                            </select></td>
                            <tr>
                                <td>
                            <label>PO Number:</label></td>
                            <td><select><option></option>
                            
                            <?php 
                                $stmt = $con->prepare("SELECT DISTINCT po_number FROM inventory ORDER BY po_number ASC");
                            	$stmt->execute();
                                $result = $stmt->get_result();
                            	while ($row = $result->fetch_assoc()) {
                            	    $po = $row['po_number'];
                            	   
                            	    echo "<option value='" . $po . "'>" .  $po . "</option>";
                            	}
                            	$stmt->close();
                                ?>
                                </select></td>
                            </tr>
            <tr><td><input type="submit" value="Submit"></td></tr>
            
        </form>
    </tbody>
</table>