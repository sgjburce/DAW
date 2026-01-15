<?php

session_start();

include("connection.php");
include("functions.php");
$user_data = check_login($connection);

$today=date("Y-m-d");
$online_threshold=time()-300;

$query_hits="SELECT COALESCE(SUM(hits),0) AS total_hits_today FROM stats WHERE date='$today'";
$result_hits=mysqli_query($connection, $query_hits);
$total_hits=mysqli_fetch_assoc($result_hits)['total_hits_today'];

$query_online="SELECT COUNT(DISTINCT ip) AS online_users FROM stats WHERE online > $online_threshold";
$result_online=mysqli_query($connection, $query_online);
$online_users=mysqli_fetch_assoc($result_online)['online_users'];

$query_users="SELECT COUNT(DISTINCT ip) AS unique_users FROM stats";
$result_users=mysqli_query($connection, $query_users);
$unique_users=mysqli_fetch_assoc($result_users)['unique_users'];

$query_page_hits="SELECT page, SUM(hits) AS page_hits FROM stats WHERE date='$today' GROUP BY page ORDER BY page_hits DESC LIMIT 10";
$result_page_hits=mysqli_query($connection, $query_page_hits);

$query_final="SELECT * FROM stats ORDER BY hits DESC LIMIT 10";
$result_final=mysqli_query($connection, $query_final);

include("header.php");

if (!isset($_SESSION['acc_type']) || $_SESSION['acc_type'] !== 'profesor') {
    // NU accesa id_profesor aici
    http_response_code(403);
    echo "<h2>Nu aveți permisiunea de a vizualiza această pagină.</h2>";
    exit;
}

    ?>
    <!DOCTYPE html>
    <html>

    <body>
    <h1>Site Statistics</h1>
    <div>Accesari Azi: <?php echo $total_hits; ?></div>
    <div>Utilizatori Online: <?php echo $online_users; ?></div>
    <div>Utilizatori Unici: <?php echo $unique_users; ?></div>

    <h2>Top 10 Pagini Vizitate Azi</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th bgcolor="#CCCCCC">IP</th>
            <th bgcolor="#CCCCCC">Data</th>
            <th bgcolor="#CCCCCC">Numar Accesari</th>
            <th bgcolor="#CCCCCC">Pagina</th>
        </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result_final)) {
    ?>
        <tr>
            <td><?php echo $row['ip']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['hits']; ?></td>
            <td><?php echo $row['page']; ?></td>
        </tr>
    <?php
    }
include("footer.php");
?>
