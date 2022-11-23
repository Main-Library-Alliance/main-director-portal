<?php
include "../config.php"

try {
    //Setup connection
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    //Query DB
    foreach($dbh->query('SELECT * FROM libraries' as $row)) {
        print_r($row);
    }
    $dbh=null;
} catch (PDOException $e) {
    print ("Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>
