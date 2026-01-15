<?php
$dbhost = "sql100.infinityfree.com";
$dbuser = "if0_40912539";
$dbpass = "aqandvhPVR";
$dbname = "if0_40912539_catalog_db";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

//aqandvhPVR
