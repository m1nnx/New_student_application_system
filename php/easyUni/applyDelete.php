<?php
    require('db-config.php');
	include("auth.php"); 

    $ic=$_SESSION['IC'];
    $query = "DELETE  from pendaftaran where IC='$ic'"; 

	if (mysqli_query($conn, $query)){
    mysqli_close($conn);
    echo "<script>alert('Deleted successfully.')</script>";
	echo "<script type='text/javascript'>window.top.location='stdupdate.php';</script>";
    exit;}
    else {
    echo "Error deleting record";}?>
<?php
mysqli_close($conn);
ob_end_flush();
?>