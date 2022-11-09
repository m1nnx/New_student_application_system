<!doctype html>
<html>
<head>	
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="favicon.png">
<link rel="stylesheet" href="staffcss.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<title>Staff Login Page</title>
</head>
<body>
	<img src="logo.png" alt="logo" width="100" height="auto">
	<div class="staffloginmain">
		<p class="staffloginsign" align="center">Staff Login Page</p>
		<form method="post" action="staffLogin.php">
			<input class="loginfield" type="text" class="form-control" name="STAFFID" placeholder="Staff ID" required>
			<input class="loginfield" type="password" class="form-control" name="PASSWORD" id="password" data-toggle="password" placeholder="Password" required>
			<center><div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input" onclick="myFunction()"> <label for="chk1" class="custom-control-label text-sm">Show Password</label> </div>
			<br><br><button type="submit" class="btn loginbtn text-center">Login</button>
			<button type="reset" name="Reset" value="Reset" class="btn btn-secondary ">Reset</button></center>
		</form>
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