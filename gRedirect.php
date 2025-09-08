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
echo "<h1>Hello $userInfo->name</h2>";
$profileDetails = $userInfo ->profile;
foreach ($profileDetails as $key => $value) {
    echo "$key: $value";
}
} catch (\Throwable $th) {
    header("Location: signin.php");
}

?>