<?php

session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

$acc_type = $_SESSION['acc_type'];

if ($acc_type === 'profesor') {
    header("Location: Note_prof.php");
    exit;
} elseif ($acc_type === 'elev') {
    header("Location: Note_elev.php");
    exit;
}

header("Location: Login.php");
exit;