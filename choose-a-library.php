<!DOCTYPE html>
<?php
        session_start();
        if (!isset($_SESSION["username"])) {
            header("Location: ../login/");
            exit();
        } else {
?>
    <label>Select a Library</label>
    <select name="libraries" id="libraries">
    <option></option>
    <?php
    include "config.php";
 $stmt = $con->prepare("SELECT library_name, library_abbr FROM libraries");
 $stmt->execute();
 $result = $stmt->get_result();

 $libraries = [];
 while ($row = $result->fetch_assoc()) {
    $libraryName = $row['library_name'];
    $abbr = $row['library_abbr'];
    echo "<option value='" . $abbr . "' name='" . $abbr . "'>" . $libraryName . "</option>";
}
 $stmt->close();

 ?>

 </select>


<?php } ?>