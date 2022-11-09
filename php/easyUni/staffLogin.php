<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="favicon.ico">
<title>Staff Login PHP</title>
</head>
<body>
<?php
$STAFFID = $_POST["STAFFID"];
$PASSWORD = $_POST["PASSWORD"];
$_SESSION["LOGOUT"]=1;
$_SESSION["STAFFID"]=$STAFFID;
$_SESSION["PASSWORD"]=$PASSWORD;
include("db-config.php");
$sql = "select * from staff where STAFFID ='$STAFFID' && BINARY PASSWORD = BINARY '$PASSWORD'";
$result = mysqli_query($conn, $sql);
$row = mysqli_num_rows($result);
if( $row == 1)
{
    while( $row = mysqli_fetch_assoc($result))
    {
        $_SESSION["NAME"] = $row["NAME"];
    }
	echo "<script> alert ('Logging in as ".$_SESSION["NAME"]."')</script>";
	echo "<script type='text/javascript'>window.top.location='newApp.php';</script>"; exit;
}
else
{
    echo "<script> alert ('Wrong username/password!')</script>";
    echo "<script type='text/javascript'>window.top.location='logout.php';</script>"; exit;
}
mysqli_close($conn);
?>
</body>
</html>