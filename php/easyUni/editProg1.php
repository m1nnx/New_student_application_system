<?php
session_start();
if(!isset($_SESSION["STAFFID"]) && !isset($_SESSION["PASSWORD"])){
   echo "<script type='text/javascript'>window.top.location='staffIndex.php';</script>"; exit;
} 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<?php
	 include("db-config.php");
	 $CODE = $_POST["CODE"];
	 $PROGRAMME = $_POST["PROGRAMME"];
	 $FACULTY = $_POST["FACULTY"];
	 $FEES = $_POST["FEES"];
	 
	 $sql = "UPDATE programme SET PROGRAMME = '$PROGRAMME', FEES = '$FEES', FACULTYID = '$FACULTY' WHERE CODE = '$CODE'";
 	 if (mysqli_query($conn, $sql)){
 	     echo "<script>alert('DATA $CODE UPDATED')</script>";
         echo "<script type='text/javascript'>window.top.location='addProg.php';</script>"; exit;
 	 }
     else{
         echo mysqli_error($conn);
     }
  mysqli_close($conn);
	?>
</body>
</html>