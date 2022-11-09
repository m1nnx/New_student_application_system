<!doctype html>
<html>
<head>	
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="favicon.png">
<link rel="stylesheet" href="studentcss.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<title>Student Login Page</title>
</head>
<body>
<img src="logo.png" alt="logo" width="100" height="auto">
<?php
        require('db-config.php');
        session_start();
        if (isset($_REQUEST['IC'])){
         // removes backslashes
         $ic = stripslashes($_REQUEST['IC']);
         //escapes special characters in a string
         $ic= mysqli_real_escape_string($conn,$ic);
         $password = stripslashes($_REQUEST['PASSWORD']);
         $password = mysqli_real_escape_string($conn,$password);
         //Checking is user existing in the database or not
         $query = "SELECT * FROM pemohon WHERE IC='$ic' and BINARY PASSWORD = BINARY '$password'";
         $result = mysqli_query($conn,$query) or die(mysql_error());
         $rows = mysqli_num_rows($result);
                
            
        if($rows==1)
		{
         $_SESSION['IC'] = $ic;
			while( $row = mysqli_fetch_assoc($result))
				{
					$_SESSION["NAME"] = $row["NAME"];
				}
		 echo "<script> alert ('Logging in as ".$_SESSION["NAME"]."')</script>";
         echo "<script type='text/javascript'>window.top.location='studentIndex.php';</script>"; exit;
         }
		else
		{
			echo "<script> alert ('Wrong username/password!')</script>";
			echo "<script type='text/javascript'>window.top.location='studentLogin.php';</script>"; exit;
		}
     }
?>
	<div class="studentloginmain">
		<p class="studentloginsign" align="center">Student Login Page</p>
		<form method="POST" action="">
			<center><input class="loginfield" type="text" class="form-control" name="IC" placeholder="IC Number" required><br><br>
			<input class="loginfield" type="password" class="form-control" name="PASSWORD" id="password" data-toggle="password" placeholder="Password" required>
			<div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input" onclick="myFunction()"> <label for="chk1" class="custom-control-label text-sm">Show Password</label> </div>
			<br><br><button type="submit" class="btn loginbtn text-center">Login</button>
			<button type="reset" name="Reset" value="Reset" class="btn btn-secondary ">Reset</button></center>
		</form>
		<p align="center">Don't have an account yet? Click <a href="studentRegister.php">here</a> to register</p>
	</div>
<script>
  function myFunction() {
	  var x = document.getElementById("password");
	  if (x.type === "password") {
		x.type = "text";
	  } else {
		x.type = "password";
	  }
	}
</script>
</body>
</html>