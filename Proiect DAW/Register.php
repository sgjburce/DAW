<?php
session_start();

  include("connection.php");
  include("functions.php");

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
      //something was posted
      $username = $_POST['username'];
      $parola = $_POST['parola'];
      $acc_type = $_POST['searchtype'];
      $nume = $_POST['nume'];
      $email = $_POST['email'];

      if(!empty($username) && !empty($parola) && !is_numeric($username))
      {

        if($acc_type == "profesor")
        {
        //save to database
          $query = "insert into profesor (username, parola, nume, email) values ('$username', '$parola', '$nume', '$email')";
        }else if($acc_type == "elev")
        {
          $query = "insert into elev (username, parola, nume, email) values ('$username', '$parola', '$nume', '$email')";
        }

        mysqli_query($connection, $query);
        echo "You have successfully registered!";
        header("Location: Login.php");
        die;
      }else
      {
        echo "Please enter valid information!";
      }
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Aplicatie Catalog</title>
</head>

<body>
    <style type="text/css">
        #text{
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
        }

        #button{
            padding: 10px;
            width: 100px;
            color: white;
            background-color: lightblue;
            border: none;
        }

        #box{
            background-color: grey;
            margin: auto;
            width: 300px;
            padding: 20px;
        }
    </style>
    <div id="box">
      <div><h1>Sign Up</h1></div>

      <form method="post">
        Choose Account Type:<br />
        <select name="searchtype">
          <option value="profesor">Profesor
          <option value="elev">Elev
        </select>
        <br />
        <p>Username</p><input id="text" type="text" name="username" size="20" maxlength="20" />
        <br />
        <p>Password</p><input id="text" type="password" name="parola" size="20" maxlength="20" />
        <br />
        <p>Nume</p><input id="text" type="text" name="nume" size="50" maxlength="50" />
        <br />
        <p>Email</p><input id="text" type="email" name="email" size="50" maxlength="50" />
        <br />
        <input id="button" type="submit" name="submit" value="Sign In">
        <a href="Login.php">Log In</a>
      </form>
    </div>
</body>
</html>