<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($connection);

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
    <h1>Selectati clasa dorita</h1>
    <table border="0" cellpadding="3">

            <?php
            $query = "select * from clasa ";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_array($result))
            {
                ?>
            <tr align="center">
                <?php $clasa = $row['an_studiu']; ?>
                <td bgcolor="#CCCCCC" align="center"><a href="Note_raw.php?clasa=<?php echo $clasa; ?>"><?php echo $clasa; ?></a></td>
            </tr>
                <?php
            }                           
            ?>
    </table>
</body>
</html>

<?php
    include("footer.php");
?>