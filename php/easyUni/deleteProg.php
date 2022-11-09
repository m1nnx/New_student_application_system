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
	$CODE = $_GET["CODE"];
	$sql1 = "DELETE FROM programme WHERE CODE = '$CODE'";
	if (mysqli_query($conn, $sql1)){
    mysqli_close($conn);
    echo "<script>alert('Programme deleted successfully.')</script>";
	echo "<script type='text/javascript'>window.top.location='addProg.php';</script>"; exit;
	}
    else {
        echo "<script>location.href='addProg.php'; alert('Programme you wish to delete is still active. Please remove programme from applicants!'); </script>";
	}?>
<?php
mysqli_close($conn);
ob_end_flush();
?>
</body>
</html>