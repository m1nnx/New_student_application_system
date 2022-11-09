<?php
ob_start();
?>
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
</head>
<body>
	<?php
	include("db-config.php");
	$FACULTYID = $_GET["FACULTYID"];
	$sql1 = "DELETE FROM faculty WHERE FACULTYID = '$FACULTYID'";
	if (mysqli_query($conn, $sql1)){
    mysqli_close($conn);
    echo "<script>alert('Faculty deleted successfully.')</script>";
	echo "<script type='text/javascript'>window.top.location='addFaculty.php';</script>"; exit;
	}
    else {
        echo "<script>location.href='addFaculty.php'; alert('Faculty you wish to delete is still active. Please remove faculty from any courses!'); </script>";
	}?>
<?php
mysqli_close($conn);
ob_end_flush();
?>
</body>
</html>