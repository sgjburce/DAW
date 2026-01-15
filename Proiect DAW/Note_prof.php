<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($connection);
    
    $id_profesor = (int)$user_data['id_profesor'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_elev = isset($_POST['id_elev']) ? (int)$_POST['id_elev'] : 0;

        // DELETE - șterge toate notele elevului date de profesorul logat
        if (isset($_POST['sterge_note_elev'])) {
            $sql = "DELETE FROM NOTA WHERE id_elev = $id_elev AND id_profesor = $id_profesor";

            if (!mysqli_query($connection, $sql)) {
                die("Eroare DELETE: " . mysqli_error($connection));
            }

            // echo "S-au șters: " . mysqli_affected_rows($connection); die;

            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        // ADD - adaugă notă
        if (isset($_POST['adauga_nota'])) {
            $nota = isset($_POST['nota']) ? (int)$_POST['nota'] : 0;

            // ia o disciplina asociata profesorului (prima gasita)
            $q = "SELECT id_disciplina FROM MATERIE_PREDATA WHERE id_profesor = $id_profesor LIMIT 1";
            $r = mysqli_query($connection, $q);
            if (!$r || mysqli_num_rows($r) === 0) {
                die("Profesorul nu are disciplina asociata.");
            }
            $id_disciplina = (int)mysqli_fetch_assoc($r)['id_disciplina'];

            if ($nota >= 1 && $nota <= 10) {
                $sql = "
                    INSERT INTO NOTA (valoare, data, id_elev, id_profesor, id_disciplina)
                    VALUES ($nota, NOW(), $id_elev, $id_profesor, $id_disciplina)
                ";

                if (!mysqli_query($connection, $sql)) {
                    die("Eroare INSERT: " . mysqli_error($connection));
                }
            }

            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }


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
        <th bgcolor="#CCCCCC">Elev</th>
        <th bgcolor="#CCCCCC">Note existente</th>
        <th bgcolor="#CCCCCC">Nota nouă</th>
        <th bgcolor="#CCCCCC">Acțiune</th>
    </tr>

<?php
$query = "SELECT e.id_elev, e.nume AS elev, GROUP_CONCAT(n.valoare ORDER BY n.data SEPARATOR ', ') AS note
    FROM ELEV e
    LEFT JOIN NOTA n
        ON n.id_elev = e.id_elev
       AND n.id_profesor = $id_profesor
    GROUP BY e.id_elev, e.nume
    ORDER BY e.nume
";

$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
    <form method="post">
        <td align="center"><?php echo htmlspecialchars($row['elev']); ?></td>

        <td align="center">
        <?php echo ($row['note'] !== null) ? htmlspecialchars($row['note']) : '-'; ?>
        </td>

        <td align="center">
        <input type="hidden" name="id_elev" value="<?php echo (int)$row['id_elev']; ?>">
        <input type="number" name="nota" min="1" max="10">
        </td>

        <td align="center">
        <input type="submit" name="adauga_nota" value="Adaugă">
        </td>

        <td align="center">
        <input
            type="submit"
            name="sterge_note_elev"
            value="Șterge toate"
            onclick="return confirm('Sigur vrei să ștergi toate notele acestui elev (doar ale tale)?');">
        </td>
    </form>
    </tr>      
<?php
}
?>
<form method="get" action="export_note.php">
    <button type="submit">Genereaza Raport XLSX</button>
</form>  
</table>
</body>
</html>

<?php
    include("footer.php");
?>




