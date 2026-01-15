<?php

session_start();

  include("connection.php");
  include("functions.php");

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
      //something was posted
      $username = $_POST['username'];
      $parola = $_POST['parola'];
      $acc_type = $_POST['acc_type'];

      if(!empty($username) && !empty($parola) && !is_numeric($username))
      {

        if($acc_type == "profesor")
        {
        //save to database
          $query = "select * from profesor where username= '$username' limit 1";
        }else if($acc_type == "elev")
        {
          $query = "select * from elev where username= '$username' limit 1";
        }
        //read from database
        $result = mysqli_query($connection, $query);

        if($result)
        {
          echo "ok1";
            if($result && mysqli_num_rows($result) > 0)
            {
                echo "ok2";
                $user_data = mysqli_fetch_assoc($result);

                if($user_data['parola'] === $parola)
                {
                    echo "ok3";
                    $_SESSION['email'] = $user_data['email'];
                    $_SESSION['acc_type'] = $acc_type;
                    header("Location: index.php");
                    die;
                }
            }
            else
            {    
            echo "Wrong username/password!";       
            }
        }else
        {
            echo "Please enter valid information!";
        }
  }
}
?>

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
      <h1>Log In</h1>

      <form method="post">
        Choose Account Type:<br />
        <select name="acc_type">
          <option value="profesor">Profesor
          <option value="elev">Elev
        </select>
        <br />
        <input id="text" type="text" name="username" size="20" maxlength="20" />
        <br />
        <input id="text" type="password" name="parola" size="20" maxlength="20" />
        <br />
        <input id="button" type="submit" name="submit" value="Login">
        <a href="Register.php">Sign In</a>
      </form>
    </div>
</body>
</html>