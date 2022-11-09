<?php 
 require('db-config.php');
 include("auth.php"); 
?>
<!doctype html>
<html>
<head>	
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="favicon.png">
<link rel="stylesheet" href="std.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>view data applied</title>
</head>
<body>
 <!----- navbar  ----->
    <div class="sidenav">
          <center><img src="logo.png"></center>
          <a class="" href="studentIndex.php">HOME</a>
          <a class="" href="stdapply.php">APPLY</a>
          <a class="" href="stdRayuan.php">RAYUAN</a>
          <a class="active" href="stdupdate.php">VIEW DATA</a>
    </div>
    <div class="main">
        <div class="button">
            <a class="button" href="stdLogout.php" onclick="return confirm('Confirm logging out?')">Log out</a>
        </div>
        <hr>

     <h2>COURSES APPLIED</h2>
     <br><br>
     <table width="100%" border="1" style="border-collapse:collapse;">
        <thead>
            <tr>
                <th><strong>DATE</strong></th>
                <th><strong>PROGRAMME</strong></th>
                <th><strong>EDUCATION<br> LEVEL</strong></th>
                <th><strong>EDUCATION <br>RESULT</strong></th>
                <th><strong>UPDATE</strong></th>
                <th><strong>DELETE</strong></th>
            </tr>
        </thead>
    <?php
        $sel_query="Select * from pendaftaran WHERE IC = '".$_SESSION['IC']."'";
        $result = mysqli_query($conn,$sel_query);
        if($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td align="center"><?php echo $row["trn_date"]; ?></td>
                    <td align="center"><?php echo $row["PROGRAMME"]; ?></td>
                    <td align="center"><?php echo $row["EDULEVEL"]; ?></td>
                    <td align="center">
                        <?php if($row["EDURESULT"] != ''){ ?>
                        <a href="uploads/<?php echo $row["EDURESULT"]; ?>" download>
                            <img src="download.png" style="width:25px; height:auto;">
                        </a>
                        <?php } ?>
                    </td>
                    <td align="center">
                        <a href="applyEdit.php?id=<?php echo $row["IC"]; ?>">
                            <img src="edit.png" style="width:25px; height:auto;">
                        </a>
                    </td>
                    <td align="center">
                        <a href="applyDelete.php?id=<?php echo $row["IC"]; ?>"  
                           onclick="return confirm('Are you sure you want to delete this item?');">
                            <img src="delete.png" style="width:25px; height:auto;">
                        </a>
                    </td>
                </tr>
                <?php } 
		 else{
			?><td colspan='6' align="center">You have not applied for any courses !</td><?php
		}?>
         </table>       
</div>
</body>
</html>