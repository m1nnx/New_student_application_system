<?php
session_start();
if(!isset($_SESSION["STAFFID"]) && !isset($_SESSION["PASSWORD"])){
  echo "<script type='text/javascript'>window.top.location='staffIndex.php';</script>"; exit;
} 
  
ini_set('display_startup_errors',1);                         
ini_set('display_errors',1);                                           
error_reporting(E_ALL);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="favicon.png">
<title>Add Faculty</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<?php include("db-config.php");
	$CODE = $_POST["CODE"];
	$FACULTY = $_POST["FACULTY"];

	$sql = "INSERT INTO faculty (FACULTYID, FACULTYNAME) values ('$CODE','$FACULTY')";
	if(mysqli_query($conn, $sql))
	{
	    echo "<script>alert('New faculty added successfully!!!')</script>";
	    echo "<script type='text/javascript'>window.top.location='addFaculty.php';</script>"; exit;
	}
    else
    {   
        echo "<script>alert('Faculty already exist!!!')</script>";
        echo "<script type='text/javascript'>window.top.location='addFaculty.php';</script>"; exit;
    }
	mysqli_close($conn);
	?>
	
</body>
</html>