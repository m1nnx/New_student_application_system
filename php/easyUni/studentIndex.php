<?php 
 require('db-config.php');
 include("auth.php");
?><head>	
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="favicon.png">
<link rel="stylesheet" href="std.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>Homepage</title>
</head>

<style>
    h1{
    font-size: 35px;
    color: ;
}
    .user-dashboard a{
    font-size: 25px;
    }
</style>
<body>
 <!----- navbar  ----->
    <div class="sidenav">
          <center><img src="logo.png"></center>
          <a class="active" href="studentIndex.php">HOME</a>
          <a class="" href="stdapply.php">APPLY</a>
          <a class="" href="stdRayuan.php">RAYUAN</a>
          <a class="" href="stdupdate.php">VIEW DATA</a>
    </div>
    <div class="main">
        <div class="button">
            <a class="button" href="stdLogout.php" onclick="return confirm('Confirm logging out?')">Log out</a>
        </div>
        <hr>
      <div class="user-dashboard">
          <h1>Welcome To EASYUNI,</h1><a><?php 
                       $result = mysqli_query($conn,"SELECT * FROM pemohon where IC = '".$_SESSION['IC']."'");
                       while($row = mysqli_fetch_array($result)){
                       echo $row["NAME"];}
                       ?></a>
      </div><br>
          <table class="table" width="50%" height="20%" border="1" style="border-collapse:collapse;">
          <?php
            $result = mysqli_query($conn,"SELECT * FROM pemohon where IC = '".$_SESSION['IC']."'");
            while($row = mysqli_fetch_array($result))
             { ?>
            <tr>
                <td><strong>IC Number</strong></td>
                <td align="center"><?php echo $row["IC"]; ?></td>
            </tr>
            <tr>
                <td><strong>Name</strong></td>
                <td align="center"><?php echo $row["NAME"]; ?></td>
            </tr>
            <tr>
                <td><strong>Gender</strong></td>
                <td align="center"><?php echo $row["GENDER"]; ?></td>
            </tr>
            <tr>
                <td><strong>Address</strong></td>
                <td align="center"><?php echo $row["ADDRESS"]; ?></td>
            </tr>
                <td><strong>Tel</strong></td>
                <td align="center"><?php echo $row["TEL"]; ?></td>
             <tr>
                <td><strong>Email</strong></td>
                <td align="center"><?php echo $row["EMAIL"]; ?></td>
             </tr>
            <?php } ?>
        
        </table>
     <br><br><br><br><br>
	
     <a>LIST OF COURSE APPLIED: </a>
     <br><br>
     <table class="table table-sm table-dark" width="100%" border="1" style="border-collapse:collapse;">
        <thead>
            <tr>
                <th><strong>DATE</strong></th>
                <th><strong>PROGRAMME</strong></th>
                <th><strong>STATUS</strong></th>
               
            </tr>
        </thead>
    <?php
        $count=1;
        $sel_query="Select * from pendaftaran where IC = '".$_SESSION['IC']."'";
        $result = mysqli_query($conn,$sel_query);
        if($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
					
                    <td align="center"><?php echo $row["trn_date"]; ?></td>
                    <td align="center"><?php echo $row["PROGRAMME"]; ?></td>
                    <td align="center"><?php echo $row["STATUS"]; ?></td>
                 </tr>
        </table>
		<?php
			if($row["STATUS"] == 'DITERIMA')
				{
					echo "<center><h2>Congratulations, your application successful!!!</h2></center>";?>
			 			<center><button type="button" onclick="window.location.href='offerLetter.php';">Download Offer Letter</button></center><?php
				}
			elseif($row["STATUS"] == 'DITOLAK'){
				echo "<center><h2>Unfortunately, your application is not successful.</h2></center>";
				}
			else{echo "<center><h2>We are currently reviewing your application.</h2></center>";}
			?><?php $count++; }
		else{
			?><td colspan='3' align="center">You have not applied for any courses !</td><?php
		}?>
    </div>
</body>
