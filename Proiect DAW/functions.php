<?php

//verificarea autentificarii utilizatorului
function check_login($connection) {
    if(isset($_SESSION['email']) && isset($_SESSION['acc_type'])) {
        $email = $_SESSION['email'];
        $acc_type = $_SESSION['acc_type'];
        if($acc_type == "profesor")
        {
        $query = "select * from profesor where email = '$email' limit 1";
        }else if($acc_type == "elev")
        {
        $query = "select * from elev where email = '$email' limit 1";
        }

        $result = mysqli_query($connection, $query);
        if($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    //redirect to login
    header("Location: Login.php");
    die;
}


function getNoteProfesor($connection, $id_profesor) {
    $id_profesor = (int)$id_profesor;

    $sql = "
        SELECT *
        FROM NOTA
        WHERE id_profesor = $id_profesor
        ORDER BY data DESC
    ";

    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die("Eroare SQL: " . mysqli_error($connection));
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function get_ip(){
    $ip=$_SERVER['REMOTE_ADDR'];

    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
} elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
}