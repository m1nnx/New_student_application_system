<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="favicon.png">
<title>Untitled Document</title>
</head>
<?php
	session_start();	
?>	
<body>
	<?php
	if(isset($_SESSION["LOGOUT"])){
	session_unset();
	 session_destroy();
	  echo "<script type='text/javascript'>window.top.location='staffIndex.php';</script>"; 
		exit;	
	}
	?>
</body>
</html>
