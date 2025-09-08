<?php

require "gClientSetup.php";
require "database.php";

if(!isset($_GET["code"])){
    echo "<script>alert('Login Failed, please retry another time')</script>";
}

try {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $oauth = new Google\Service\Oauth2($client);

    $userInfo = $oauth->userinfo->get();
    // Convert object to array for iteration
    $profileDetails = get_object_vars($userInfo);

    foreach ($profileDetails as $key => $value) {
        echo "<p><strong>$key</strong>: $value</p>";
    }

    // database logs
    $name = explode($userInfo["name"]," ");
    $first_name = $name[0];
    $surname = $name[1]??"";
    $last_name = $name[2]??"";
    $id = $userInfo["id"];
    $email_address = $userInfo["email"];
    $sql_add_user = "
                        INSERT INTO users(id, first_name, last_name, surname, email_address)
                        VALUES ('$id','$first_name', '$last_name', '$surname', '$email')
    ";
    try{
        mysqli_query($conn, $sql_add_user);
        header("Location: index.php");
    }
    catch(Exception $e){
        if (str_contains($e->getMessage(), 'Duplicate entry')) {
        $error = "Duplicate entry!";
        }
        else {
            $error = "Could not register user. <br>Try again later!";
        }
    }

} catch (\Throwable $th) {
    header("Location: signin.php");
}


?>