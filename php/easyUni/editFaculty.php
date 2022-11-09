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
<title>Edit Faculty Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="staffcss.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <a class="navbar-brand" href="#"><center><img src="logo.png"></center></a>
  <ul class="navbar-nav">
    <li class="nav-item"><a class="nav-link" href="newApp.php">NEW APPLICATION</a></li>
    <li class="nav-item "><a class="nav-link" href="updateApp.php">LIST OF APPLICANTS</a></li>
	<li class="nav-item"><a class="nav-link" href="updateRayuan.php">RAYUAN</a></li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          EXPORT TO FORMS
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="form1.php">STUDENT LIST</a>
		</div>
    </li>
	 <li class="nav-item dropdown active" >
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ADD
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="addFaculty.php">FACULTY</a>
		  <a class="dropdown-item" href="addProg.php">PROGRAMME</a>
		</div>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
	  <li class="nav-item"><a class="nav-link">Current user: <?php echo $_SESSION['NAME'] ?></a></li>
	  <?php include("db-config.php");
	  $hold = $_SESSION['STAFFID'];
	  $sql = "SELECT * FROM staff WHERE STAFFID LIKE 'Admin%' AND STAFFID = '$hold'  ;";
	  $result = mysqli_query($conn, $sql);
	  $row = mysqli_num_rows($result);
	  if($row>0)  
	  {?>
	     <li class="nav-item"><a class="nav-link" href="addUser.php">ADD USER</a</li><?php 
	  }?>
	  <li class="nav-item active"><a class="nav-link" href="logout.php" onclick="return confirm('Confirm logging out?')"><span class="fa fa-sign-out"></span> Logout</a></li>
  </ul>
</nav>
	<?php include("db-config.php");
	 $FACULTYID = $_GET["FACULTYID"]; 
	$sql="SELECT * FROM faculty WHERE FACULTYID = '$FACULTYID';";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($result);
	if($row==1){
		while($row=mysqli_fetch_assoc($result)){
	    echo "<h2 align = center>EDIT/UPDATE FACULTY DETAILS</h2>";
		echo "<b><p align = center>",$row["FACULTYNAME"] . "  (".$FACULTYID.")</p></b>";	
		$FACULTYID = $row["FACULTYID"];
		$FACULTYNAME = $row["FACULTYNAME"];
		}
	}
	?>
	<div>
    <div class="container" style="width: 40%">
	<form action="editFaculty1.php" method="post">
	CODE :<p class="form-control" style="color:gray"><?php echo $FACULTYID;?></p>
	FACULTY :<input type="text" name="FACULTYNAME" value="<?php echo $FACULTYNAME;?>" class="form-control" required>
	<input type="hidden" value="<?php echo $FACULTYID;?>" name="FACULTYID"><br><div align="center"><button type="submit" class="btn btn-primary" onclick="return confirm('Click OK to confirm update faculty details.');">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div></form></div>
</div>
	
	
<?php  mysqli_close($conn);?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>