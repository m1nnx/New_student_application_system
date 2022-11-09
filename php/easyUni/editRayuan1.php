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
	 $IC = $_POST["IC"];
	 $STATUS = $_POST["STATUS"];
	 include("db-config.php");
	 $sqlPemohon = "UPDATE rayuan SET STATUS ='$STATUS' WHERE IC = '$IC'";
    if(mysqli_query($conn,$sqlPemohon))
	{
   echo "<script>alert('DATA UPDATED')</script>"; 
	}
	  echo "<script type='text/javascript'>window.top.location='updateRayuan.php';</script>"; exit;
  mysqli_close($conn);
	?>
</body>
</html>