<?php
    session_start();
    if(!isset($_SESSION["IC"])){
        header("Location: studentLogin.php");
        exit(); 
    }
    ?>