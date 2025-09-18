<?php

require "../api.php";
require "functions.php";
session_start();

// Read the variables sent via POST from our API
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

switch($text){
    case "":
        $response  = "
        CON Welcome to laBanca! 
        1. Register for an account 
        2. Log into an existing account 
        ";
        break;
    case "1":
        $response = "
        END Please visit www.labanca.com/register to register for an account \n
        ";
        break;
    case "2":
        $response ="
        CON Provide your username, email address or account number \n
        ";
        $explode_text= explode("*",$text);
        $user_username = end($explode_text);
        $result = checkRegistration($user_username);
        if ($result == 0) {
            $response = "
            END User not found please register for an account by visiting www.labanca.com/register
            ";
        }
        break;
    case "2*{$user_username}":
        $response ="
        CON Enter your password\n
        ";
        $explode_text= explode("*",$text);
        $user_password = end($explode_text);
        break;
    case $user_password:
        if (password_verify($password, $user_password)) {
            $response = "login successful!";
        }
        else {
            $response = "Incorrect password!";
        }

    
}

// Echo the response back to the API
header('Content-type: text/plain');
echo $response;