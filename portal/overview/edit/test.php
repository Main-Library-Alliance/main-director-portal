<?php

include "../config.php";
?>


<form method="POST" action="test2.php" enctype="multipart/form-data">
    <label>Name:</label><input type="text" name="text"><br><br>
    <label>Survey</label>
<input type="file" name="networkSurvey" id="upload2" class="inputfile" /><br><br>
<label>Diagram</label>
<input type="file" name="networkDiagram" id="upload" class="inputfile"/><br><br>
<input type="submit" name="submit">
</form>


