<?php
include "../database.php";
function checkRegistration($user_username){
    $verify_user = "SELECT * FROM users WHERE username = '$user_username' OR email_address = '$user_username' OR id='$user_username'";
    $result = mysqli_query($GLOBALS["conn"], $verify_user);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        return $user['id'];
    }
    else{
        return 0;
    }
}

function verifyUser($id, $user_password){
    $verify_user = "SELECT password FROM users WHERE id = '$id'";
    $result = mysqli_query($GLOBALS["conn"], $verify_user);
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row["password"];
    if (password_verify($user_password, $hashedPassword)) {
        return 1;
    } else {
        return 0;
    }
}

function requestBalance($id){
    $query = "SELECT balanxce FROM users WHERE id = '$id'";
    $result = mysqli_query($GLOBALS["conn"], $query);
    $row = mysqli_fetch_assoc($result);
    return $row["password"];
}