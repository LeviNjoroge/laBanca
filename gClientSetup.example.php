<?php

require __DIR__ . "../vendor/autoload.php";

$client = new Google\Client();
$client->setClientId("YOUR_CLIENT_ID_GOES_HERE");
$client->setClientSecret("YOUR_CLIENT_SECRET_GOES_HERE");
$client->setRedirectUri("SET_AS_PROMPTED");

$client -> addScope("email");
$client -> addScope("profile");

?>