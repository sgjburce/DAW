<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($connection);
    
    $id_elev = (int)$user_data['id_elev'];

    include("header.php");
?>

<!DOCTYPE html>
<html>

<body>
    <style>
    h1{
        font-family: Arial, sans-serif;
        color: #020a7aff;
        margin: 0;
        padding: 0;
    }
    p{
        font-family: Arial, sans-serif;
        font-size: 14px;
        color:black;
    }
    a{
        color: #000000ff;
        text-decoration: none;
        font-family: Arial, sans-serif;
    }
    </style>
    <h1>Note</h1>

<table border="0" cellpadding="5">
    <tr>
        <th bgcolor="#CCCCCC">Materie</th>
        <th bgcolor="#CCCCCC">Profesor</th>
        <th bgcolor="#CCCCCC">Nota</th>
    </tr>

<?php

$query = "SELECT d.nume AS materie, p.email AS email_profesor, n.valoare AS nota
FROM nota n
JOIN disciplina d ON d.id_disciplina = n.id_disciplina
JOIN profesor p   ON p.id_profesor   = n.id_profesor
WHERE n.id_elev = $id_elev
ORDER BY d.nume, n.data DESC
";

$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
    <form method="post">
        <td align="center"><?php echo htmlspecialchars($row['materie']); ?></td>
        <td align="center"><?php echo htmlspecialchars($row['email_profesor']); ?></td>
        <td align="center"><?php echo htmlspecialchars($row['nota']); ?></td>
    </form>
    </tr>      
<?php
}
?>
<form method="get" action="export_note_elev.php">
    <button type="submit">Genereaza Raport XLSX</button>
</form>  
</table>
</body>
</html>

<?php
    include("footer.php");
?>
