<?php

// sign in page
include("database.php");
session_start();

if(isset($_POST["signin"])){
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    $verify_user = "SELECT * FROM users WHERE username = '$username' OR email_address = '$username'";

    $result = mysqli_query($conn, $verify_user);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user_username = $user["username"];
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
        // setcookie("user_id", $user["id"], time() + (60*60*24)); // cookie lasts a day
        
        if (password_verify($password, $user_password)) {
            $error = "login successful!";
            if ($user_username == 'admin') {
                header("Location: /admin/admin.php");
            }
            else {
                header("Location: index.php");
            }
        }
        else {
            $error = "Incorrect password!";
        }
    }
    else {
        $error = "Incorrect username !";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBanca</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Welcome Back to LaBanca</h1>
        <h2>Signin Form</h2>
        <form action="" method="post">
            <label for="username">Username / Email:</label>
            <input type="text" name="username" id="username" placeholder="joe_doe" required> <br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="********" required> <br>

            <input type="submit" value="Sign In" name="signin" id="submit"> Don't have an account? <a href="signup.php">Register here</a>!  <br>
            <br>
            
            <p id="error">
            <?php
            if (isset($error)) {
                echo $error;
            }
            ?>
            </p>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>