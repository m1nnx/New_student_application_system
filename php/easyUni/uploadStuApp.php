<?php
    include("db-config.php");
    include("auth.php");    
        
    if (isset($_POST['submit'])){
        $trn_date = date("Y-m-d H:i:s");
        $ic = $_SESSION['IC'];
        $code = $_POST['PROGRAMME'];
        $eduLevel = $_POST['EDULEVEL'];
        $filename = $_FILES["uploadfile"]["name"];
        $hostel = $_POST["HOSTEL"];
        $income = $_POST["INCOME"];
        
        
		$sql = "SELECT P.PROGRAMME AS PROGRAMME ,F.FACULTYNAME AS FACULTYNAME FROM programme P inner join faculty F ON F.FACULTYID=P.FACULTYID where P.CODE='$code'";
		$query_run = mysqli_query($conn, $sql);
		if($row = mysqli_fetch_assoc($query_run))
		{
			$faculty = $row['FACULTYNAME'];
			$programme = $row['PROGRAMME'];
		}
        
		
    if($filename != '')
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg',  'gif'];
    
        //check if file type is valid
        if (in_array($ext, $allowed))
        {

                $filename = $ic . '-' . $filename;

            //set target directory
            $path = 'uploads/';
                
            
        move_uploaded_file($_FILES['uploadfile']['tmp_name'],($path . $filename));
        $query = "INSERT INTO `pendaftaran`(`trn_date`,`IC`,`PROGRAMME`,`FACULTY`,`EDULEVEL`,`EDURESULT`,`HOSTEL`,`INCOME`)VALUES ('$trn_date','$ic','$programme','$faculty','$eduLevel','$filename','$hostel','$income')";
        
        $query_run = mysqli_query($conn, $query);
        
        if($query_run){
            echo  '<script type = "text/javascript"> alert("Data Saved")</script>';
			echo "<script type='text/javascript'>window.top.location='studentIndex.php';</script>"; exit;
        }
        else{
            echo '<script type = "text/javascript"> alert("Data NOT Saved")</script>';
        }
    }}}

?>