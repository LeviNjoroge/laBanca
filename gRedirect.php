<?php
session_start();
require "gClientSetup.php";
require "database.php";

if (!isset($_GET["code"])) {
    echo "<script>alert('Login Failed, please retry another time')</script>";
    exit;
}
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

    echo $id,"<br>",$first_name,"<br>",$last_name,"<br>",$surname,"<br>",$email_address;

    
    // Insert user into DB
    $sql_add_user = "
        INSERT INTO users(id, first_name, last_name, surname, email_address)
        VALUES ('$id','$first_name', 
        " . ($last_name ? "'$last_name'" : "NULL") . ",
        " . ($surname ? "'$surname'" : "NULL") . ",
        '$email_address')";

    echo "<script>alert('query prepared')</script>";

    mysqli_query($conn, $sql_add_user);
    $verify_user = "SELECT * FROM users WHERE id = '$id'";

    $result = mysqli_query($conn, $verify_user);

            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['username'] = $user["username"];
                $user_password = $user["password"];
                $_SESSION['first_name'] = $user["first_name"];
                $_SESSION['last_name'] = $user["last_name"];
                $_SESSION['id'] = $user["id"];
                $_SESSION['id_no'] = $user["national_id_no"];
                $_SESSION['date_of_birth'] = $user["date_of_birth"];
                $_SESSION['surname'] = $user["surname"];
                $_SESSION['email'] = $user["email_address"];
                $_SESSION['phone'] = $user["phone_number"];
                $_SESSION['balance'] = $user["balance"];
                $_SESSION['profile_picture'] = $user["profile_picture"] ?? 'default.jpeg';
            }
    header("Location: index.php");
    exit;
?>
