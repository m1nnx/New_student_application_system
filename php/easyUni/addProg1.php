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
<title>Add Programme</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<?php include("db-config.php");
	$CODE = $_POST["CODE"];
	$PROGRAMME = $_POST["PROGRAMME"];
	$FACULTY = $_POST["FACULTY"];
	$FEES = $_POST["FEES"];

	$sql = "INSERT INTO programme (CODE, PROGRAMME, FEES, FACULTYID) values ('$CODE','$PROGRAMME', '$FEES','$FACULTY')";
	if(mysqli_query($conn, $sql))
	{
	    echo "<script>alert('New programme added successfully!!!')</script>";
	    echo "<script type='text/javascript'>window.top.location='addProg.php';</script>"; exit;
	}
    else
    {   
        echo "<script>alert('Programme already exist!!!')</script>";
        echo "<script type='text/javascript'>window.top.location='addProg.php';</script>"; exit;
    }
	mysqli_close($conn);
	?>
	
</body>
</html>