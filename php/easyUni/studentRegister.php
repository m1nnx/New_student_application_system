<!DOCTYPE html>
<html>
<head>	
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="favicon.png">
<link rel="stylesheet" href="studentcss.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<title>Register Student Account</title>
</head>
<body>
    <?php
       require('db-config.php');
       if (isset($_POST['submit'])){
        $ic = $_POST['IC'];
        $name = $_POST['NAME'];
        $gender_value = $_POST['GENDER'];
        $address = $_POST['ADDRESS'];
        $tel = $_POST['TEL'];
        $email = ($_POST['EMAIL']);
        $password = stripslashes($_POST['PASSWORD']);
        $password = mysqli_real_escape_string($conn,$password);
        
        $query = "insert into pemohon (IC,NAME,GENDER,ADDRESS,TEL,EMAIL,PASSWORD)VALUES ('$ic','$name','$gender_value','$address','$tel','$email','$password')";
        
        $result = mysqli_query($conn, $query);
        if($result){
			echo "<script> alert ('You have successfully registered!')</script>";
			echo "<script type='text/javascript'>window.top.location='studentLogin.php';</script>"; exit;
		}
       }
   
    ?>
	<div class="studentregister">
			<p class="studentloginsign" align="center">Register Student Account</p>
			<form method="POST" action="studentRegister.php" enctype="multipart/form-data">
				<center>
					<input class="loginfield" type="text" class="form-control" name="IC" placeholder="IC" required>
					<br><br>
					<input class="loginfield" type="text" class="form-control" name="NAME" placeholder="NAME" required>
					<br><br>
					<strong>GENDER</strong>
						<input type="radio" id="male" name="GENDER" value="Male">Male
						<input type="radio" id="female" name="GENDER" value="Female">Female
					<br><br>
					<textarea class="loginfield" name="ADDRESS" rows="4" cols="50" placeholder="ADDRESS"></textarea>
					<br><br>
					<div class="row">
						<div class="column">
							<input class="loginfield" type="text" class="form-control" name="TEL" placeholder="PHONE" required>
						</div>
						<div class="column">
							<input class="loginfield" type="text" class="form-control" name="EMAIL" placeholder="EMAIL" required>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="column">
							<input class="loginfield" type="password" class="form-control" name="PASSWORD" id="password" data-toggle="password" placeholder="PASSWORD" required>
							<div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input" onclick="passwordToggle()"> <label for="chk1" class="custom-control-label text-sm">Show Password</label> </div>
						</div>
						<div class="column">
							<input class="loginfield" type="password" class="form-control" name="CONFIRM" id="confirm" data-toggle="password" placeholder="CONFIRM PASSWORD" required>
							<div class="custom-control custom-checkbox custom-control-inline"> <input id="chk2" type="checkbox" name="chk" class="custom-control-input" onclick="confirmToggle()"> <label for="chk2" class="custom-control-label text-sm">Show Password</label> </div>
						</div>
					</div>
					<br><button type="submit" name="submit" class="btn loginbtn text-center" onclick="return Validate();">Register</button>
					<button type="reset" name="Reset" value="Reset" class="btn btn-secondary ">Reset</button>
				</center>
			</form>
	</div>
<script>
	function passwordToggle() {
		var x = document.getElementById("password");
		if (x.type === "password" ) {
		x.type = "text";
		} else {
		x.type = "password";
		}
	}

	function confirmToggle() {
		var x = document.getElementById("confirm");
		if (x.type === "password" ) {
		x.type = "text";
		} else {
		x.type = "password";
		}
	}
	
	function Validate() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
		else
			{
				return confirm("Continue submission?");
			}
        return true;
    }
</script>
</body>
</html>
