<?php
require "../api.php";
require "functions.php";
session_start();

// $sessionId   = $_POST["sessionId"];
// $serviceCode = $_POST["serviceCode"];
// $phoneNumber = $_POST["phoneNumber"];
$text        = $_GET["text"];

$level = explode("*", $text);

if ($text == "") {
    // First menu
    $response  = "CON Welcome to laBanca!\n";
    $response .= "1. Register for an account\n";
    $response .= "2. Log into an existing account\n";

} elseif ($level[0] == "1") {
    // Registration path
    $response = "END Please visit www.labanca.com/register to register for an account";

} elseif ($level[0] == "2" && !isset($level[1])) {
    // Ask for username/email/account number
    $response = "CON Provide your username, email address or account number";

} elseif ($level[0] == "2" && isset($level[1]) && !isset($level[2])) {
    // Check if user exists
    $user_username = $level[1];
    $user_id = checkRegistration($user_username);

    if ($user_id == 0) {
        $response = "END User not found. Please register at www.labanca.com/register";
    } else {
        $_SESSION["id"] = $user_id;
        $response = "CON Enter your password";
    }

} elseif ($level[0] == "2" && isset($level[2])) {
    // Verify password
    // $user_username = $level[1]; 
    $user_password = $level[2];
    if(verifyUser($_SESSION["id"], $user_password)){
        $response = "CON Log in Successful!
        Select a service:
        1. Deposit funds
        2. Withdraw funds
        3. Check Account balance
        4. Mini statement
        5. Account settings
        ";
    } else{
        $response = "END Incorrect password, please try again later!";
    }
}
elseif($level[3] == "1"){
    $response = "CON Diposit: 
    Enter the amount";
}
elseif($level[3] == "2"){
    $response = "CON Withdrawal:
    Enter the amount";
}
elseif($level[3] == "3"){
    $balance = 
    $response = "END Your account balance is {$balance}";
}
elseif($level[3] == "4"){
    $response = "";
}
elseif($level[3] == "5"){
    $response = "";
}
header('Content-type: text/plain');
echo $response;
