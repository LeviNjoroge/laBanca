<?php
// sign in page
include("database.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Demo</title>
</head>
<body>
    <div class="form-container">
        <h2>Signin Form</h2>
        <form action="" method="post">
            <label for="username">Username / Email:</label>
            <input type="text" name="username" id="username" placeholder="joe_doe" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="********" required>

            <input type="submit" value="Sign In" name="signin">
            
        </form>
    </div>
</body>
</html>

<?php
static $count = 3;
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
    
    if (password_verify($password, $user_password)) {
        echo "login successful";
        header("Location: index.php");
    }
    else {
        echo "Incorrect password";
        
    }
}
else {
    $count--;
    echo "Incorrect username <br>You have {$count} more trys remaining";
    if ($count <1) {
        header("Location: signup.php");
    }
}

mysqli_close($conn);
?>