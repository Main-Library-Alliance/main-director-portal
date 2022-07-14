<!DOCTYPE html>
<?php 
include "../../auth.php";
include "../../adminOnly.php";
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>Choose a Library</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="scripts/jquery.tablesorter.min.js"></script>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
    <div class="portalContainer">
        <?php include '../../header.php'; ?>
        
        <div class="flex">
        <?php include '../../portal/sidebar.php'; ?>
        
        <main>
            <h1>eContent GP - Choose a Library</h1>
<form method="GET" action="library.php">
<?php include "../../choose-a-library.php"; ?>
    <input type="submit" id="generateText" name="view" value="Submit">
    </form>


