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
    <h1>This is the Catalog</h1>
    <p>Hello, <?php echo $user_data['username']; ?>. You are logged in as <?php echo $_SESSION['acc_type']; ?></p>
</body>
</html>

<?php
    include("footer.php");
?>