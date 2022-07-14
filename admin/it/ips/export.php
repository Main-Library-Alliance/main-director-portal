<?php
include "../../../auth.php";
include "../../../adminOnly.php";
include "../../../config.php";

$query = $con->query("SELECT libraries.id, libraries.library_name, ip_addresses.ip_addr_1, ip_addresses.ip_addr_2 FROM libraries JOIN ip_addresses ON libraries.id = ip_addresses.library_id ORDER BY libraries.library_name ASC");

if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "library-ips_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('ID', 'LIBRARY', 'STATIC_IP', 'BACKUP IP'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['id'], $row['library_name'], $row['ip_addr_1'], $row['ip_addr_2']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>