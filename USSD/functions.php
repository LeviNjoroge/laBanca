<?php
include "../database.php";
function checkRegistration($user_username){
    $verify_user = "SELECT * FROM users WHERE username = '$user_username' OR email_address = '$user_username' OR id='$user_username";

    $result = mysqli_query($GLOBALS["conn"], $verify_user);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        return $user;
    }
    else{
        return 0;
    }
}

