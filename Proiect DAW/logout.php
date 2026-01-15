<?php

session_start();

if(isset($_SESSION['email']))
{
    unset($_SESSION['email']);
}
//redirect to login
header("Location: Login.php");  
die;
session_destroy();
?>
