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
        $_SESSION['id'] = $user["id"]; ////////
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
    <!-- Google OAuth -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <meta name="google-signin-client_id" content="YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com">
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

            <input type="submit" value="Sign In" name="signin" id="submit"> 
            
            <!-- Google OAuth Divider -->
            <div class="oauth-divider">
                <span>or</span>
            </div>
            
            <!-- Google Sign In Button -->
            <div id="g_id_onload"
                 data-client_id="YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com"
                 data-context="signin"
                 data-ux_mode="popup"
                 data-callback="handleGoogleSignIn"
                 data-auto_prompt="false">
            </div>
            
            <div class="g_id_signin"
                 data-type="standard"
                 data-shape="rectangular"
                 data-theme="outline"
                 data-text="signin_with"
                 data-size="large"
                 data-logo_alignment="left"
                 data-width="100%">
            </div>
            
            <div class="signup-link">
                Don't have an account? <a href="signup.php">Register here</a>!
            </div>
            
            <p id="error">
            <?php
            if (isset($error)) {
                echo $error;
            }
            ?>
            </p>
        </form>
    </div>
    
    <script>
        // Handle Google Sign-In response
        function handleGoogleSignIn(response) {
            console.log('Google Sign-In Response:', response);
            
            // Send the Google credential token to your PHP backend
            fetch('google_oauth.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    credential: response.credential,
                    action: 'signin'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect to dashboard on successful authentication
                    window.location.href = data.redirect || 'index.php';
                } else {
                    // Show error message
                    alert(data.message || 'Authentication failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred during authentication');
            });
        }
    </script>
</body>
</html>

<?php
mysqli_close($conn);
?>