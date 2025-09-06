<?php

require "gClientSetup.php";


if(isset($_GET["code"])){
    echo "
    <script>alert('Login Failed, please retry another time')</script>
    ";
}

$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
$client->setAccessToken($token['access_token']);

$oauth = new Google\Service\Oauth2($client);

?>