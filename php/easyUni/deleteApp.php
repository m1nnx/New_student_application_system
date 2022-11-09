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
	$IC = $_GET["IC"];
	$sql1 = "DELETE FROM pendaftaran WHERE IC = $IC";
	$sql2 = "DELETE FROM pemohon WHERE IC = $IC";
	if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)){
    mysqli_close($conn);
    echo "<script>alert('Deleted successfully.')</script>";
	echo "<script type='text/javascript'>window.top.location='updateApp.php';</script>";
    exit;}
    else {
    echo "Error deleting record";}?>
<?php
mysqli_close($conn);
ob_end_flush();
?>
</body>
</html>