<?php

require "api.php";

// Read the variables sent via POST from our API
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

switch($text){
    case "":
        $response  = "
        CON Welcome to laBanca! \n
        1. Register for an account \n
        2. Log into an existing account \n
        ";
        break;
    case "1":
        $response = "
        END Please visit www.labanca.com/register to register for an account \n
        ";
}

// Echo the response back to the API
header('Content-type: text/plain');
echo $response;