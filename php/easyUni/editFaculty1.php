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
	 $FACULTYID = $_POST["FACULTYID"];
	 $FACULTYNAME = $_POST["FACULTYNAME"];

	 
	 $sql = "UPDATE faculty SET FACULTYNAME = '$FACULTYNAME' WHERE FACULTYID = '$FACULTYID'";

 	 if (mysqli_query($conn, $sql)){
 	     echo "<script>alert('DATA $FACULTYID UPDATED')</script>";
         echo "<script type='text/javascript'>window.top.location='addFaculty.php';</script>"; exit;
 	 }
     else{
         echo mysqli_error($conn);
     }
  mysqli_close($conn);
	?>
</body>
</html>