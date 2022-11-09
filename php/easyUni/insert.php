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
<link rel="icon" href="favicon.png">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<?php
	$STATUS = $_POST["STATUS"];
	$IC = $_POST["IC"];
	$NAMA = $_POST["NAMA"];
	$TARIKH_MOHON = $_POST["TARIKH_MOHON"];
	$JANTINA = $_POST["JANTINA"];
	$WARGANEGARA = $_POST["WARGANEGARA"];
	include("db-config.php");
    if(strpos($IC, "-") == true){
        echo "<script>alert('IC/Passport cannot contain dash!!!')</script>";
        echo "<script type='text/javascript'>window.top.location='insert1.php';</script>"; exit;
    }
    else{
        $sql = "INSERT INTO pemohon (IC, NAME, TARIKH_MOHON, JANTINA, WARGANEGARA, STATUS) values ('$IC','$NAMA','$TARIKH_MOHON','$JANTINA','$WARGANEGARA', '$STATUS')";
	    if (!mysqli_query($conn,$sql)){
	        echo "<script>alert('Applicant already exist!!!')</script>";
            echo "<script type='text/javascript'>window.top.location='insert1.php';</script>"; exit;
	    }
	    $sql = "INSERT INTO pendaftaran (IC,NAMA) VALUES ('$IC','$NAMA')";
		mysqli_query($conn,$sql);
    }
    if($STATUS == 'DITERIMA'){
	echo "<script type='text/javascript'>window.top.location='updateStaff.php'; alert('New employee inserted.'); </script>"; exit;}
	else{echo "<script type='text/javascript'>window.top.location='JTK1.php'; alert('New employee inserted.')</script>"; exit;}
	mysqli_close($conn);
	?>
</body>
</html>