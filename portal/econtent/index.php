<?php 
include "../../auth.php";
include "../../adminOnly.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>eContent Dashboard</title>
        <link rel="stylesheet" href="../../../assets/css/style.css">
        <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="portalContainer">
            <?php include "../../header.php"; ?>
            <div class="flex">
            <?php include "../../portal/sidebar.php"; ?>
            
            <main>
                <h1>eContent Dashboard</h1>
                
                <div class="grid">
                    <a href="/portal/econtent/choose.php">
                        <div class="item">
                        Choose a Library
                        </div>
                    </a>
                    <a href="/portal/econtent/view.php">
                        <div class="item">
                        View All
                        </div>
                    </a>
                    
                
                </div>
                
            </main>
            
            <style>
                .grid {
                    display:flex;
                    flex-wrap:wrap;
                    max-width:900px;
                }
                .item {
                    font-size:30px;
                    background-color:var(--mainblue);
                    width:270px;
                    color:white;
                    padding:30px;
                    height:300px;
                    margin-right:30px;
                    margin-bottom:30px;
                }
                .item a {
                    color:white;
                }
            </style>