<?php
include "../config.php";
date_default_timezone_set("US/Eastern");
$date = date("Y-m-d");




//"if statement"

if (is_uploaded_file($_FILES['networkSurvey']['tmp_name'])) {
//if (!empty ($_FILES['networkSurvey'])){
//if(!file_exists($_FILES['networkSurvey']['nSurvey']) || !is_uploaded_file($_FILES['networkSurvey']['nSurvey'])) {
// do nothing 
// if (isset($_FILES['networkSurvey']) AND !empty($_FILES['networkSurvey'])) {




    echo "networkSurvey set";
  //  $name = $_POST['text'];
  //  $surveyLastUpdate = $date;
    
  //  $stmt = $con->prepare("INSERT INTO test(name, surveyLastUpdate) VALUES (?, ?)");
  //  $stmt->bind_param("ss", $name, $surveyLastUpdate);
  //	$stmt->execute();
  //	$stmt->close();
}

if (is_uploaded_file($_FILES['networkDiagram']['tmp_name'])) {
//if (isset($_FILES['networkDiagram']) AND !empty($_FILES['networkDiagram'])) {
    echo "networkDiagram set";
}

echo "<br>this always runs...</br>";

?>