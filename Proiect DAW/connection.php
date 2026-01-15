<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "catalog";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

//aqandvhPVR