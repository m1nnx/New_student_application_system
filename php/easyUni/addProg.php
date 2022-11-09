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
<title>Add Programme</title>
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
<div class="row">
    <div class="column" style="background-color:white; width: 65%;">
        <?php include("db-config.php");
        $sql = "SELECT C.CODE AS CODE, C.PROGRAMME AS PROGRAMME, C.FEES AS FEES, F.FACULTYNAME AS FACULTY FROM faculty F INNER JOIN programme C ON C.FACULTYID=F.FACULTYID;";
        $result = mysqli_query($conn, $sql);
	    $row = mysqli_num_rows($result);
        if($row>0)
        {?><div style="width:90%;  margin-left: auto">
             <div style="table-responsive"><table id="myTable" class="display table-striped"> <thead>
                   <tr><h2 align="center">LIST OF PROGRAMMES</h2>
                   <th><b>CODE</b></th>
                   <th><b>PROGAMME</b></th>
				   <th><b>FEES</b></th>
                   <th><b>FACULTY</b></th>
                   <th><b>ACTION</b></th></tr> </tr></thead><tbody><?php 
            while($row = mysqli_fetch_assoc($result))
            {
                ?><tr>
                       <td><?php echo $row["CODE"];?></td>
			           <td><?php echo $row["PROGRAMME"];?></td>
				 	   <td><?php echo $row["FEES"];?></td>	
			           <td><?php echo $row["FACULTY"];?></td>
			           <td><a href="editProg.php?CODE=<?php echo $row['CODE'];?>"><i class="fa fa-edit fa-fw " style="color:blue" alt="Edit"></i></a>
			<a href="deleteProg.php?CODE=<?php echo $row['CODE'];?>" onclick="return myFunction()"><i class="fa fa-trash fa-fw " style="color:red" alt="Delete"></i></a></td></tr><?php
            }
        }else
		{ echo "<h2 style='padding-left:120px;'>No existing programme.</h2>";}
        print "</tbody></table></div>";
        mysqli_close($conn);
        ?>
				 
	<?php include("db-config.php");	
	$sql3 = "SELECT FACULTYID,FACULTYNAME FROM faculty;";
	$result = mysqli_query($conn,$sql3);
	$row = mysqli_num_rows($result);
	if($row==1){
		while($row=mysqli_fetch_assoc($result)){
		$FACULTYID = $row["FACULTYID"];
	    $FACULTYNAME = $row["FACULTYNAME"];
		}
	}
	if (!mysqli_query($conn,$sql3)){
	    echo mysqli_error($conn);
	}
	?>
				 
    </div></div>
    <div class="column" style="background-color:white; width: 30%;">
		<h2 align="center">ADD NEW PROGRAMME</h2>
		<div class="container" style="width: 70%">
        <form action="addProg1.php" method="post">
	       <div class="form-group">CODE :<input type="text" name="CODE" class="form-control" required></div>
		   <div class="form-group">PROGRAMME NAME :<input type="text" name="PROGRAMME" class="form-control" required></div>
		   <div class="form-group">PROGRAMME FEE :<input type="text" name="FEES" class="form-control" required></div>
		   <div class="form-group">FACULTY :
	    <select  name="FACULTY" id="FACULTY" class="form-control">
		<?php
		  $sql="SELECT * FROM faculty";
		  $result = mysqli_query($conn,$sql);
		  while($data = mysqli_fetch_array($result))
		  {
			  echo "<option value= ".$data["FACULTYID"].">".$data["FACULTYNAME"]."</option>";
		  }
		?></select></div>
		   <br><div align="center"><button type="submit" class="btn btn-primary" onclick="return confirm('Click OK to confirm adding programme.');">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div></form></div>
	</div>
</div>
<script>function myFunction(){var r=confirm("Are you sure you want to delete this programme from the database?");if(r==false){return false;}}</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script></script><script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script><script>$(document).ready(function() {    $('#myTable').DataTable();} );</script>
</body>
</html>