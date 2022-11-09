<!doctype html>
<?php 
 require('db-config.php');
 include("auth.php");
?>
<html>
<head>	
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="favicon.png">
<link rel="stylesheet" href="std.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>APPEAL</title>
</head>
<style>
    .form-group a{
        font-size: 12px; 
    }
    .form-group label{
        font-size: 12px; 
    }
    .form-group c{
        font-size: 16px;
    }
    .form-group select{
        font-size: 16px;
        width: 95%;
        height: 95%;
    }
    .table-form{
        width: 450px;
        height: 400px;
        border-radius: 20px;
    }
    
</style>
<body>
 
    <!----- navbar  ----->
    <div class="sidenav">
          <center><img src="logo.png"></center>
          <a class="" href="studentIndex.php">HOME</a>
          <a class="" href="stdapply.php">APPLY</a>
          <a class="active" href="stdRayuan.php">RAYUAN</a>
          <a class="" href="stdupdate.php">VIEW DATA</a>
    </div>

    <div class="main">
        <div class="button">
            <a class="button" href="stdLogout.php" onclick="return confirm('Confirm logging out?')">Log out</a>
        </div>
		<hr>

		<?php 
	$sel_query="Select * from pendaftaran where STATUS = 'DITOLAK' and IC = '".$_SESSION['IC']."'";
	$result = mysqli_query($conn,$sel_query);
	if($row = mysqli_fetch_assoc($result)) {?>
        
		<?php 
		$sel_query="Select * from rayuan where IC = '".$_SESSION['IC']."'";
    	$result = mysqli_query($conn,$sel_query);
		
    	if($row = mysqli_fetch_assoc($result)) {
				echo "<center><h2>You have applied!</h2></center>";
		}
		
		else{?>
		<h1>APPEAL SECTION</h1>
        <p>Fill up the form below: </p>
        <br><br>
        <center>
            <!----------------------------------- FORM START------------------------------------->
            <form action="uploadRayuan.php" method="POST" enctype="multipart/form-data">
            <table class="table-form">
                <!----------------------ic---------------------------->
            <td>
                <div class="form-group">
                    <a>IC NUMBER</a><br>
                     <c><?php 
                       require('db-config.php');
                       $result = mysqli_query($conn,"SELECT * FROM pemohon where IC = '".$_SESSION['IC']."'");
                       while($row = mysqli_fetch_array($result)){
                       echo $row["IC"];}
                       ?></c>
                </div><br>
            
                <!-----------------------program---------------------------->
            
                <div class="form-group">
                    <label>PROGRAMME</label><br>
                    <select name="PROGRAMME" class="form-control" required>
                       <option selected hidden value=""> --Select Programme-- </option>
                                <?php
									include("db-config.php");
		  							$sql="SELECT * FROM programme";
		  							$result = mysqli_query($conn,$sql);
		  							while($data = mysqli_fetch_array($result))
		  							{
			  							echo "<option value= ".$data["CODE"].">".$data["PROGRAMME"]."</option>";
		  							}
								?>
                    </select>
                </div><br>
            
                <!-----------------------edulevel------------------------->
            
                <div class="form-group">
                    <label>EDUCATION LEVEL </label><br>
                    <select name="EDULEVEL" class="form-control" id="exampleFormControlSelect1" required>
                        <option selected hidden value=""> --Select Education Level-- </option>
                        <option value="SPM">SPM</option>
						<option value="MATRICULATION">MATRICULATION</option>
						<option value="FOUNDATION">FOUNDATION</option>
						<option value="DIPLOMA">DIPLOMA</option>
                    </select>
					<p style="font-size: 13px;">Note: Refers to programme entry requirement.<p>
                </div><br>
        
                <!-----------------------DROP RESUME---------------------------->
        
                <div class="form-group">
                    <label>DROP EDUCATION RESULT</label><br>
                    <input type="file" name="uploadfile" class="form-control-file" id="uploadfile" required>
                </div>
                <br>
                <!----------------------kolej---------->
                <div class="form-group">
                    <label>HOSTEL NEEDED?</label><br>
                    <select name="HOSTEL" class="form-control" id="exampleFormControlSelect1" required>
                        <option selected hidden value=""> --Your Answer-- </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div><br>
                <!-----------------------income-------->
                <div class="form-group">
                    <a>YOUR FAMILY INCOME<br>RM</a>
                    <input type="text" name="INCOME" required>
                    
                </div><br>
                <!-----------------------SUBMIT BUTTON---------------------------->
                <center>
                <button class="btn btn-dark" name="submit" id="done" type="submit" value="Submit">Submit</button>
                <button class="btn btn-secondary" type="reset" id="rest" onclick="return confirm('Reset Form?')">Reset</button>
                </center>
            </td>
            </table>
            </form>
            <br>
    <!---------------------------------------------- form end ----------------------------------------->
     </center><?php }?>
		
     <br><br><br>
     <a>LIST OF APPEAL: </a>
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
        
        $sel_query="Select * from rayuan WHERE IC = '".$_SESSION['IC']."'";
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
					echo "<center><h2>Congratulations, your appeal application successful!!!</h2></center>";?>
			 		<center><button class="btn btn-dark" type="button" onclick="window.location.href='offerLetterRayuan.php';">Download Offer Letter</button></center><?php
				}
			elseif($row["STATUS"] == 'DITOLAK'){
				echo "<center><h2>Unfortunately, your appeal application is not successful.</h2></center>";
				}
			else{echo "<center><h2>We are currently reviewing your appeal application.</h2></center>";}
		?><?php } else{
		?><td colspan='3' align="center">You have not applied for any courses !</td><?php
		}?>
</div>
	<?php }
	else{
		echo "<center><h2>Sorry, you are not eligible to appeal.</h2></center>";
	}?>
</body>
</html>












































