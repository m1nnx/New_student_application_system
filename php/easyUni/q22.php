	
<html>
<head>
</head>
<body>
<?php
	$app_id=$_POST["app_id"];
	$username="root";
	$password="admin";
	$host="localhost";
	$dbname="sv_appointment";
		
	$conn = mysql_connect($host, $username, $password);
	
	if(isset($conn))
	{
		mysql_select_db($dbname, $conn)or
		die("<center>Error: " .mysql_error() ."</center>");
	}else
	{
		echo "<center>Error: Could not connect to the database.</center>";	
	}
	
	$sql="select * from student_fyp where app_id = '$app_id'";
	$result=mysqli_query($conn, $sql);
	$row = mysqli_num_rows($result);
	while($row = mysqli_fetch_assoc($result)){?>
		<center>
		<h1>STUDENT - SUPERVISOR INFORMATION</h1>
		<form  action="" name="update" method="post">
			<table border="1">
			<tr>
				<th colspan="2">STUDENT INFORMATION</th>
			</tr>
			<tr>
				<td>Student No.</td>
				<td><?php echo $row["student_no"];?></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><?php echo $row["student_name"];?></td>
			</tr>
			<tr>
				<td>Contact</td>
				<td><?php echo $row["student_contact"];?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?php echo $row["student_email"];?></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<th colspan="2">SUPERVISOR INFORMATION</th>
			</tr>
			<tr>
				<td>Name</td>
				<td><?php echo $row["supervisor_name"];?></td>
			</tr>
			<tr>
				<td>Contact</td>
				<td><?php echo $row["supervisor_contact"];?></td>
			</tr>
			<tr>
				<td>Date Applied</td>
				<td><?php echo $row["request_date"];?></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<th colspan="2">APPROVAL STATUS</th>
			</tr>
			<tr>
				<td>Status</td>
				<td><select name="upStatus" class="form-control" id="upStatus" required>
                        <option value="acc">ACCEPTED</option>
						<option value="rej">REJECTED</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Changes Date</td>
				<td><input type="date" id="date" name="date"></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="submit" value="submit"></td>
			</tr>
		</table>
	</form>
	</center>
	<?php}
?>
			
<?php

	if(isset($_POST['submit'] )){
		
	$username="root";
	$password="admin";
	$host="localhost";
	$dbname="sv_appointment";
		
	$conn = mysql_connect($host, $username, $password);
	
	if(isset($conn))
	{
		mysql_select_db($dbname, $conn)or
		die("<center>Error: " .mysql_error() ."</center>");
	}else
	{
		echo "<center>Error: Could not connect to the database.</center>";	
	}
		
    $status=$_POST["upStatus"];
	$date=$_POST["date"];
	$app_id=$_POST["app_id"];
		
	$sql = "UPDATE student_fyp SET approval_status ='$status', changes_date='$date' WHERE app_id = '$app_id'";
    if(mysqli_query($conn,$sql))
	{
   		echo "<script>alert('DATA UPDATED')</script>"; 
	}else{
	  echo "“Cannot update the status.”"; 
	}
  mysqli_close($conn);
	}
?>
</script>
</body>
</html>
