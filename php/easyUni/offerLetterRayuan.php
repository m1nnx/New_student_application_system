<?php
ob_start();
?>
<?php 
 require('db-config.php');
 include("auth.php");?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Offer Letter</title>
	
	<style>		
		table,th,td{
			border: 0.3px solid black;
			border-collapse: collapse;
			font-family: Calibri, Arial;
			font-size: 12px;
			text-align: center;
		    
		}
		
		#t02{
			text-align: center;
		}
		#t01{
		    border-bottom: hidden;
		}
		#t03{
			border-left: hidden;
			border-bottom: hidden;
			border-right: hidden;
			border-top: hidden;
			padding-left: 25px;
		}
		#t04
		{
			padding: 25px;
			border-left: hidden;
			border-bottom: hidden;
			border-right: hidden;
			border-top: hidden;
		}
	</style>
</head>

<body>
	
		<div align="left" style="font-size: 18px;font-family: Calibri, Arial;">Offer Letter<br>
	
		<?php
 		$sql ="SELECT P.IC as IC, P.NAME as NAME, P.ADDRESS AS ADDRESS, P.TEL AS TEL, P.EMAIL AS EMAIL, P.GENDER AS GENDER, PD.PROGRAMME as PROGRAMME, PD.FACULTY as FACULTY, PD.EDULEVEL AS EDULEVEL, PD.EDURESULT AS RESULT,PD.HOSTEL AS HOSTEL, PD.INCOME AS INCOME, PD.STATUS AS STATUS
		FROM rayuan PD
		INNER JOIN pemohon P
		ON P.IC=PD.IC WHERE PD.IC='".$_SESSION['IC']."'
		";
			
		$result = mysqli_query($conn,$sql);
		$row = mysqli_num_rows($result);
		if($row = mysqli_fetch_assoc($result)){?>
			<?php echo $row['ADDRESS'];?>
			<br><br>
			Dear <?php echo $row['NAME'];?>,
			<br><br>
			Congratulations! University Teknologi Utara is offering you a place for <?php echo $row['PROGRAMME'];?> class of 2021.
			After reviewing your application and all the supporting documents, we have determined that you are exactly the kinf of student that we 
			are looking for to carry on the University Teknologi Utara success.<br><br>
			
			Attached to this letter you will find a full admission package, along with information regarding programme offered:<br><br>
			
			Program : <?php echo $row['PROGRAMME'];?><br>
			Faculty : <?php echo $row['FACULTY'];?><br>
			
			<?php
			$sql1= "SELECT FEES FROM programme WHERE PROGRAMME = '".$row['PROGRAMME']."'";
			$result1 = mysqli_query($conn,$sql1);
			$row1 = mysqli_num_rows($result1);
			if($row1 = mysqli_fetch_assoc($result1))
				
				if($row['INCOME'] <= 2500){
					$registrationFees = 80 * 0.70;
					$ProgFees = $row1['FEES'] * 0.70;
					?><br>Your application is eligible for "Bantuan Ihsan Pelajar". (30% Fees Reduction)<br>
						Program Fee : RM<?php echo $ProgFees;?><br><?php
					if($row['HOSTEL'] == 'YES'){
						$hostelFees = 315 * 0.70;
						?>Hostel Fee (1st Semester) : RM<?php echo $hostelFees;?><br><?php
					}else{
						$hostelFees = 0;
						?>Hostel Fee (1st Semester) : None<br><?php
					}
					?>Registration Fee : RM<?php echo $registrationFees;?><br><?php
				}
				else{
					$registrationFees = 80;
					$ProgFees = $row1['FEES'];
					?><br>Program Fee :<?php echo $ProgFees;?><br><?php
					if($row['HOSTEL'] == 'YES'){
						$hostelFees = 315;
						?>Hostel Fee (1st Semester) : RM<?php echo $hostelFees;?><br><?php
					}else{
						$hostelFees = 0;
						?>Hostel Fee (1st Semester) : None<br><?php
					}
					?>Registration Fee : RM<?php echo $registrationFees;?><br><?php
				}
				$totalFees=$ProgFees+$hostelFees+$registrationFees;							   
			?>
				<br><br>Your total admission fees is RM<?php echo $totalFees;?><br><br><?php	
				?>We look foward to having you at our university this upcoming academic year.<br><br><?php							
			 }?>
			
			

	</div></div>
	<?php 
		/**
		 * Export as word document
		**/ 
	  	header("Content-Type: application/vnd.ms-word");
     	header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
     	header("content-disposition: attachment;filename=Offerletter.doc");
		
	    include("db-config.php");

    ?>
		
	 <br>
		<div align="left" style="font-family: Calibri, Arial;font-size: 12px"><p>Stamp of student recruitment department &nbsp; :</p>
		       <p>Signature of Officer &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;:</p>
		<p>Date &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</p>
		</div>
			
<?php
mysqli_close($conn);
ob_end_flush();
?>
</body>
</html>
