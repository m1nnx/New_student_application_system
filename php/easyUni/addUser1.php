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
<title>Add User</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<?php include("db-config.php");
	$STAFFID = $_POST["STAFFID"];
	$NAME = $_POST["NAMA"];
	$PASSWORD = $_POST["PASSWORD"];
	$sql = "INSERT INTO staff (STAFFID, NAME, PASSWORD) values ('$STAFFID','$NAME','$PASSWORD')";
	if(mysqli_query($conn, $sql))
	{
	    echo "<script>alert('New user created successfully!!!')</script>";
	    echo "<script type='text/javascript'>window.top.location='addUser.php';</script>"; exit;
	}
    else
    {
        echo "<script>alert('ID already exist!!!')</script>";
        echo "<script type='text/javascript'>window.top.location='addUser.php';</script>"; exit;
    }
	mysqli_close($conn);
	?>
</body>
</html>