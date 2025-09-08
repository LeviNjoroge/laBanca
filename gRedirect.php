<?php

require "gClientSetup.php";

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
    $firstname = $name[0];
    $surname = $name[1]??"";
    $lastname = $name[2]??"";

} catch (\Throwable $th) {
    header("Location: signin.php");
}


?>