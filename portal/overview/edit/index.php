<!DOCTYPE html>

<html>
<head>
  <meta charset="UTF-8">
  <title>Library Info Database</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="scripts/jquery.tablesorter.min.js"></script>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <?php include '../header.php'; ?>
        <div class="content">
            

    <?php
    include "../config.php";
 $stmt = $con->prepare("SELECT library_name FROM data_table");
 $stmt->execute();
 $result = $stmt->get_result();

 $libraries = [];
 while ($row = $result->fetch_assoc()) {
     $libraries[] = $row['library_name'];
 }
 $stmt->close();
 ?>
 
 <form method="POST" action="edit.php">
     <label>Select a Library</label> 
     <select name="libraries" id="libraries">
         <option></option>
     </select>
    <input type="submit" id="generateText" name="generateText" value="Submit">
</form>
<script>
    // this part grabs the array of unique categories from the PHP and passes it to JS
    var libArr = <?php echo json_encode($libraries); ?>;


    // this dynamically creates a selectbox for all available categories
    for (let i = 0; i < libArr.length; i++) {
        $('#libraries').append('<option value="' + libArr[i] + '" name="' + libArr[i] + '">' + libArr[i] + '</option>');
    }

</script>

<?php //} ?>