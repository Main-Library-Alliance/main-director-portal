<!DOCTYPE html>
<?php
        session_start();
        if (!isset($_SESSION["username"])) {
            header("Location: ../login/");
            exit();
        } else {
?>
<html>
<head>
  <meta charset="UTF-8">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../scripts/jquery.tablesorter.min.js"></script>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <?php include "../header.php"; ?>
        <table id="table">
            <thead>
                <th>Name <i class="fa fa-sort fa-1x"></i></th>
                <th>Abbr. <i class="fa fa-sort fa-1x"></i></th>
                <th>Admin Pass. <i class="fa fa-sort fa-1x"></i></th>
                <th>Menu? <i class="fa fa-sort fa-1x"></i></th>
                <th>Wifi? <i class="fa fa-sort fa-1x"></i></th>
                <th>TC #1 <i class="fa fa-sort fa-1x"></i></th>
                <th>TC #2 <i class="fa fa-sort fa-1x"></i></th>
                <th>Email <i class="fa fa-sort fa-1x"></i></th>
                <th>Drive <i class="fa fa-sort fa-1x"></i></th>
                <th>Env <i class="fa fa-sort fa-1x"></i></th>
                <th>PCR <i class="fa fa-sort fa-1x"></i></th>
                <th>LPT <i class="fa fa-sort fa-1x"></i></th>
                <th>AAM <i class="fa fa-sort fa-1x"></i></th>
                <th>MPS <i class="fa fa-sort fa-1x"></i></th>
                <th>MGL User <i class="fa fa-sort fa-1x"></i></th>
                <th>MGL Pass <i class="fa fa-sort fa-1x"></i></th>
                
            </thead>
            <tbody>
                

        
    <?php
    include "../config.php";
     $stmt = $con->prepare("SELECT * FROM data_table");
            $stmt->execute();
            $result = $stmt->get_result();
              while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['library_name'];
                $abbr = $row['library_abbr'];
                $adminpw = $row['admin_pw'];
                $menu = $row['menu_page'];
                $wifi = $row['wifi_page'];
                $tc1 = $row['tech_contact_one_name'];
                $tc2 = $row['tech_contact_two_name'];
                $email = $row['library_email'];
                $drive = $row['google_drive'];
                $env = $row['envisionware'];
                $pcres = $row['env_pc_res'];
                $lpt = $row['env_lpt_print'];
                $aam = $row['env_aam'];
                $mps = $row['env_mobile_print'];
                $maguser = $row['magellan_user'];
                $magpass = $row['magellan_pass'];
                ?>
                
                <tr>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $abbr; ?></td>
                    <td><?php echo $adminpw; ?></td>
                    <td><?php echo $menu; ?></td>
                    <td><?php echo $wifi; ?></td>
                    <td><?php echo $tc1; ?></td>
                    <td><?php echo $tc2; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $drive; ?></td>
                    <td><?php echo $env; ?></td>
                    <td><?php echo $pcres; ?></td>
                    <td><?php echo $lpt; ?></td>
                    <td><?php echo $aam; ?></td>
                    <td><?php echo $mps; ?></td>
                    <td><?php echo $maguser; ?></td>
                    <td><?php echo $magpass; ?></td>
                </tr>
                
                
                
                <?php
              }
              
              ?>
              
                          </tbody>
        </table>
        
        <style>
            .container {
                max-width:100%;
            }
            table {
                layout:fixed;
            }
        </style>
        
        <script>
$(function() {
  $("#table").tablesorter();
});
           
        </script>
        
        <?php } ?>