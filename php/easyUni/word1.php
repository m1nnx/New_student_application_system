<?php
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="favicon.png">
<title>WORD 1</title>
	
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
	
		<div align="center" style="font-size: 14px;font-family: Calibri, Arial;">EASY-UNI STUDENT APPLICATION SYSTEM<br>
	    LIST OF APPLICANTS &amp; STUDENTS<br>
	    TITLE :___________________________________________________<br></div>
	    <br>
	
		<table style="width:110%"><tr>
		<th style="width: 3%"> <?php $_POST["IC"] ?>BIL</th>
		<th style="width:6%">IC</th>
		<th style="width:10%">NAME</th>
		<th style="width:6%">ADDRESS</th>
		<th style="width:6%">TEL</th>
		<th style="width:6%">EMAIL</th>
		<th style="width:6%">GENDER</th>
		<th style="width:6%">PROGRAMME</th>
		<th style="width:6%">FACULTY</th>
		<th style="width:6%">EDUCATION LEVEL</th>
		</tr>
				
	</div>
	<?php 
		/**
		 * Export as word document
		**/ 
	  	header("Content-Type: application/vnd.ms-word");
     	header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
     	header("content-disposition: attachment;filename=StudentList.doc");
		
	    include("db-config.php");
	
   /**
    * Fetch data from the database
    **/	

	$BIL =0;


	if(isset($_POST['submit'])){
			
    if(!empty($_POST["IC"]))
	{	$IC1 =$_POST["IC"] ;
        // loop to retrieve checked values
        foreach($IC1 as $k => $IC){
			$BIL++;
		     
			$sql ="SELECT P.IC as IC, P.NAME as NAME, P.ADDRESS AS ADDRESS, P.TEL AS TEL, P.EMAIL AS EMAIL, P.GENDER AS GENDER, PD.PROGRAMME as PROGRAMME, PD.FACULTY as FACULTY, PD.EDULEVEL AS EDULEVEL, PD.EDURESULT AS RESULT, PD.STATUS AS STATUS
			FROM pendaftaran PD
			LEFT JOIN pemohon P
			ON P.IC=PD.IC WHERE PD.IC='$IC'
			";
			
			$result = mysqli_query($conn,$sql);
			$row = mysqli_num_rows($result);
			if($row ==1)
			{
			  while($row = mysqli_fetch_assoc($result))
			  {
			   
			   $subIC=$row["IC"];
			   $NRIC= substr($subIC,0,6);
			   $NRIC.="-";
			   $NRIC.=substr($subIC,-6,2);
			   $NRIC.="-";
			   $NRIC.=substr($subIC,-4,4);	 
	 	       print "<tr>
			   <td>$BIL</td> 
			   <td>".$NRIC."</td>
			   <td>".$row["NAME"]."</td>
			   <td>".$row["ADDRESS"]."</td>
			   <td>".$row["TEL"]."</td>
			   <td>".$row["EMAIL"]."</td>
			   <td>".$row["GENDER"]."</td>
			   <td>".$row["PROGRAMME"]."</td>
			   <td>".$row["FACULTY"]."</td>
			   <td>".$row["EDULEVEL"]."</td>

	      	   </tr> ";
				
			
			  }

				}
			  }
			}
			else {
                  echo "!0 results";
                 }
        }
	
    echo "</table>";
		
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
