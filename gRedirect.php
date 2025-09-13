<?php

require "gClientSetup.php";
require "database.php";

if (!isset($_GET["code"])) {
    echo "<script>alert('Login Failed, please retry another time')</script>";
    exit;
}

try {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $oauth = new Google\Service\Oauth2($client);

    $userInfo = $oauth->userinfo->get();

    // Split name into parts
    $nameParts = explode(" ", $userInfo->name);
    $first_name = $nameParts[0] ?? "";
    $surname    = $nameParts[1] ?? "";
    $last_name  = $nameParts[2] ?? "";

    // Collect details
    $id = $userInfo->id;
    $email_address = $userInfo->email;

    // echo $id,$first_name, $last_name,$surname,$email_address;

    // Insert user into DB
    $sql_add_user = "
        INSERT INTO users(id, first_name, last_name, surname, email_address)
        VALUES ('$id','$first_name', '$last_name', '$surname', '$email_address')
    ";
    echo "<script>alert('query prepared')</script>";

    try {
        mysqli_query($conn, $sql_add_user);
        echo "<script>alert('Was unable to populate dtb')</script>";
        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        if (str_contains($e->getMessage(), 'Duplicate entry')) {
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Could not register user. Try again later!')</script>";
            header("Location: signin.php");
            exit;
        }
    }
    $_SESSION['id'] = $id; ////////


} catch (\Throwable $th) {
    echo "<script>alert('".$th->getMessage()."')</script>";
    header("Location: signin.php");
    echo "<script>console.log('".$th->getMessage()."')</script>";
    // exit;
}

?>
