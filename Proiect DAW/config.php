<?php

$ip = get_ip();
$date = date("Y-m-d");
$time = time();
$page=$_SERVER['REQUEST_URI'];

$sqlCheck = "SELECT hits FROM stats WHERE ip='$ip' AND date='$date' AND page='$page'";
$checkStats = mysqli_query($connection, $sqlCheck);

if(mysqli_num_rows($checkStats)>0){
    $sqlUpdate = "UPDATE stats SET hits=hits+1, online='$time' WHERE ip='$ip' AND date='$date' AND page='$page'";
    mysqli_query($connection, $sqlUpdate);
} else {
    $sqlInsert = "INSERT INTO stats (ip, date, hits, page, online) VALUES ('$ip', '$date', 1, '$page', '$time')";
    mysqli_query($connection, $sqlInsert);
}