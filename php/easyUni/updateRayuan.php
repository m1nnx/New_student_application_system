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
<html><head>
<meta charset="utf-8">
<link rel="icon" href="favicon.png">
<title>List of Appeal</title>
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
	<h3 align="center" >LIST OF APPEAL</h3>
	<?php include("db-config.php");
	$sql = "SELECT P.IC as IC, P.NAME as NAME, P.ADDRESS AS ADDRESS, P.TEL AS TEL, P.EMAIL AS EMAIL, P.GENDER AS GENDER, PD.PROGRAMME as PROGRAMME, PD.FACULTY as FACULTY, PD.EDULEVEL AS EDULEVEL, PD.EDURESULT AS RESULT, PD.STATUS AS STATUS
	FROM rayuan PD
	LEFT JOIN pemohon P
	ON P.IC=PD.IC;";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_num_rows($result);
	if($row>0)
	{?><center><div style="width:90%;font-size:14px;" class="font-weight-normal">
		<div style="table-responsive"><table id="myTable" class="display table-striped"><thead>
                   <tr>
                   <th><b>IC</b></th>
                   <th><b>NAME</b></th>
                   <th><b>ADDRESS</b></th>
                   <th><b>TEL</b></th>
                   <th><b>EMAIL</b></th>
                   <th><b>GENDER</b></th>
                   <th><b>PROGRAMME</b></th>
                   <th><b>FACULTY</b></th>
                   <th><b>EDU-LEVEL</b></th>
                   <th><b>EDU-RESULT</b></th>
                   <th><b>STATUS</b></th>
                   <th>ACTION</th></tr></thead><tbody><?php 
		while($row = mysqli_fetch_assoc($result))
		{
			?><tr>
			<td><?php echo $row["IC"];?></td>
			<td><?php echo $row["NAME"];?></td>
			<td><?php echo $row["ADDRESS"];?></td>
			<td><?php echo $row["TEL"];?></td>
			<td><?php echo $row["EMAIL"];?></td>
			<td><?php echo $row["GENDER"];?></td>
			<td><?php echo $row["PROGRAMME"];?></td>
			<td><?php echo $row["FACULTY"];?></td>
			<td><?php echo $row["EDULEVEL"];?></td>
			<td><a href="uploadsRayuan/<?php echo $row["RESULT"]; ?>" target="_blank">View</a>&nbsp  &nbsp
				<a href="uploadsRayuan/<?php echo $row["RESULT"]; ?>" download>Download<a/></td>
			<td><?php echo $row["STATUS"];?></td>
			<td><a href="editRayuan.php?IC=<?php echo $row['IC'];?>"><i class="fa fa-edit fa-fw " style="color:blue" alt="Edit"></i></a>
			<a href="deleteApp.php?IC=<?php echo $row['IC'];?>" onclick="return myFunction()"><i class="fa fa-trash fa-fw " style="color:red" alt="Delete"></i></a></td></tr><?php 
		}
	}else{
		echo "<br><p align=center>Sorry, there is no new rayuan application.</p><br>";
	}
	print "</tbody></table></div>";
	mysqli_close($conn);
	?></div></div></center>
	
	
	
	
	
<script>function myFunction(){var r=confirm("Are you sure you want to delete this applicant from the database?");if(r==false){return false;}}</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>$(document).ready(function() {    $('#myTable').DataTable(); } );</script><script>
</body>
</html>
