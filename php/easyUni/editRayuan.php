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
<title>Edit Appeal Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="staffcss.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <a class="navbar-brand" href="#"><center><img src="logo.png"></center></a>
  <ul class="navbar-nav">
    <li class="nav-item"><a class="nav-link" href="newApp.php">NEW APPLICATION</a></li>
    <li class="nav-item"><a class="nav-link" href="updateApp.php">LIST OF APPLICANTS</a></li>
	<li class="nav-item active"><a class="nav-link" href="updateRayuan.php">RAYUAN</a></li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          EXPORT TO FORMS
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="form1.php">STUDENT LIST</a>
		</div>
    </li>
	 <li class="nav-item dropdown">
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
	 $IC = $_GET["IC"]; 
	$sql="SELECT * FROM pemohon WHERE IC='$IC'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($result);
	if($row==1){
		while($row=mysqli_fetch_assoc($result)){
	    echo "<h2 align = center>EDIT/UPDATE APPEAL DETAILS</h2>";
	    echo "<b><p align = center>",$row["NAME"] . "  (".$IC.")</p></b>";		 
		$NAME = $row["NAME"];
		$ADDRESS = $row["ADDRESS"];
		$TEL = $row["TEL"];
		$EMAIL = $row["EMAIL"];
		$GENDER = $row["GENDER"];
		}
	}
	$sql3 = "SELECT P.IC as IC, P.NAME as NAME, PD.PROGRAMME as PROGRAMME, PD.FACULTY as FACULTY, PD.EDULEVEL AS EDULEVEL, PD.EDURESULT AS RESULT,PD.HOSTEL AS HOSTEL, PD.INCOME AS INCOME, PD.STATUS AS STATUS
	FROM rayuan PD
	LEFT JOIN pemohon P
	ON P.IC=PD.IC WHERE PD.IC ='$IC'";
	$result = mysqli_query($conn,$sql3);
	$row = mysqli_num_rows($result);
	if($row==1){
		while($row=mysqli_fetch_assoc($result)){
	    $IC = $row["IC"];
	    $NAME = $row["NAME"];
	    $PROGRAMME = $row["PROGRAMME"];
	    $FACULTY = $row["FACULTY"];
	    $EDULEVEL = $row["EDULEVEL"];
	    $EDURESULT = $row["RESULT"];
		$HOSTEL = $row["HOSTEL"];
		$INCOME = $row["INCOME"];
		$STATUS = $row["STATUS"];
		}
	}
	if (!mysqli_query($conn,$sql3)){
	    echo mysqli_error($conn);
	}
	?>
	<div >
	<form action="editRayuan1.php" method="post"><div id="table"><table align="center" width="60%">
	<tr><td id="textAl">IC</td><td><?php echo $IC;?></td></tr>
	<tr><td id="textAl">NAME</td><td><?php echo $NAME;?></td></tr>
	<tr><td id="textAl">PROGRAMME</td><td><?php echo $PROGRAMME; ?></td></tr>

	<tr><td id="textAl">FACULTY</td><td><?php echo $FACULTY; ?></td></tr>
	<tr><td id="textAl">EDUCATION LEVEL (HIGHEST) </td><td><?php echo $EDULEVEL; ?></td></tr>
	<tr><td id="textAl">EDUCATION RESULT </td><td><a href="uploads/<?php echo $EDURESULT; ?>" target="_blank">View</a>&nbsp  &nbsp
												  <a href="uploads/<?php echo $EDURESULT; ?>" download>Download<a/></td></tr>
	<tr><td id="textAl">HOSTEL</td><td><?php echo $HOSTEL; ?></td></tr>
	<tr><td id="textAl">FAMILY INCOME</td><td><?php echo $INCOME; ?></td></tr>
	<?php 
    if ($STATUS == "DITERIMA"){?>
	<tr><td id="textAl">STATUS</td><td><input type="radio" id="DITERIMA" name="STATUS" value="DITERIMA" checked><label for="DITERIMA">DITERIMA</label>
	<input type="radio" id="DITOLAK" name="STATUS" value="DITOLAK" ><label for="DITOLAK">DITOLAK</label></td></tr>
		<?php }?>
	<?php 
    if ($STATUS == "DITOLAK"){?>
	<tr><td id="textAl">STATUS</td><td><input type="radio" id="DITERIMA" name="STATUS" value="DITERIMA" ><label for="DITERIMA">DITERIMA</label>
	<input type="radio" id="DITOLAK" name="STATUS" value="DITOLAK" checked><label for="DITOLAK">DITOLAK</label></td></tr>
		<?php }?>
	<?php if ($STATUS == ""){?>
	<tr><td id="textAl">STATUS</td><td><input type="radio" id="DITERIMA" name="STATUS" value="DITERIMA" ><label for="DITERIMA">DITERIMA</label>
	<input type="radio" id="DITOLAK" name="STATUS" value="DITOLAK" ><label for="DITOLAK">DITOLAK</label></td></tr>
		<?php }?>
		</td></tr>
	</table><input type="hidden" value="<?php echo $IC;?>" name="IC"><br>
		<div align="center"><button type="submit" class="btn btn-primary" onclick="return confirm('Click OK to confirm updating applicants details.');">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div></div></form>
</div>
<?php  mysqli_close($conn);?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>