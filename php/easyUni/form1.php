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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="favicon.png">
<title>Export to Form</title>
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
    <li class="nav-item dropdown active">
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
	<h2 align="center">EXPORT TO FORM</h2>
	<center><div style="width:100%;font-size:14px;" class="font-weight-normal">
	<?php include("db-config.php");
   $sql = "SELECT P.IC as IC, P.NAME as NAME, P.ADDRESS AS ADDRESS, P.TEL AS TEL, P.EMAIL AS EMAIL, P.GENDER AS GENDER, PD.PROGRAMME as PROGRAMME, PD.FACULTY as FACULTY, PD.EDULEVEL AS EDULEVEL, PD.EDURESULT AS RESULT, PD.STATUS AS STATUS
	FROM pendaftaran PD
	INNER JOIN pemohon P
	ON P.IC=PD.IC WHERE STATUS is NOT null;";
   $result= mysqli_query($conn,$sql);
   $row = mysqli_num_rows($result);
   if($row>0)
   {?> <form action="word1.php" method="post"><div class="container"><div class="col-md-50"><div style="table-responsive"><table id="myTable" class="display table-striped">
	   <thead><tr><th></th><th>IC</th><th style="padding-right: 100px">NAME</th><th style="padding-right: 100px">ADDRESS</th><th>TEL</th><th>EMAIL</th><th>GENDER</th><th>PROGRAMME</th><th>FACULTY</th><th>EDU-LEVEL</th><th>STATUS</th></tr></thead><tbody>
	   <?php
	  
	   while($row = mysqli_fetch_assoc($result))
	   {   
		   print "<tr><td><input class='form-check-label' type=checkbox name=IC[] value=".$row["IC"]."><td>".$row["IC"]."</td><td>".$row["NAME"]."</td><td>".$row["ADDRESS"]."</td><td>".$row["TEL"]."</td><td>".$row["EMAIL"]."</td><td>".$row["GENDER"]."</td><td>".$row["PROGRAMME"]."</td><td>".$row["FACULTY"]."</td><td>".$row["EDULEVEL"]."</td><td>".$row["STATUS"]."</td></tr>";
	   }
   }
	print "</tbody></table></div>";
	mysqli_close($conn);
	?></div></div></div></div></center>
	<div align="center" class="locFix"><input type="submit" name="submit" class="btn btn-primary" value="EXPORT"></div></form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>$(document).ready(function(){$('#myTable').DataTable({stateSave:true,stateDuration:120,dom:"<'row'<'col-sm-2'l><'col-sm-3'B><'col-sm-4'<'toolbar'>><'col-sm-3'f>>"+"<'row'<'col-sm-50'tr>>"+"<'row'<'col-sm-5'i><'col-sm-7'p>>",buttons:[{extend:'print',text:'<i class="fa fa-print"></i> Print',className:'btn btn-primary btn-md'},{extend:'excel',text:'<i class="fa fa-file-excel-o"></i> Excel',className:'btn btn-primary btn-md'}],});}); </script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script> 
</body>
</html>