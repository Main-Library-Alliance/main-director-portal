<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>eContent</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
<body>
    <div class="container">
        

<?php
include "../config.php";
include "../header.php";


$stmt = $con->prepare("SELECT * FROM econtent");
	$stmt->execute();
    $result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
		$name = $row['name'];
		echo "<input type='checkbox' id='econtent' name='" . $name . "' value='" . $name . "'>";
		echo "<label for='" . $name . "'>" . $name . "</label><br>";
	}
	
	$stmt->close();

?>
<style>
    label {
        font-weight:bold;
    }
</style>