<?php
// the registration form
include("database.php");
session_start();


if (isset($_POST["signup"])) {
    $first_name = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS) ?: NULL;
    $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_SPECIAL_CHARS);
    $date_of_birth = $_POST["date_of_birth"];
    $id = filter_input(INPUT_POST,"id",FILTER_VALIDATE_INT);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL) ?? NULL;
    $phone = $_POST["phone"] ?? NULL;
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    echo $phone . "<br>";
    echo $last_name . "<br>";

    $sql_add_user = "
                        INSERT INTO users(first_name, last_name, surname, date_of_birth, national_id_no, username, email_address, phone_number, password)
                        VALUES ('$first_name', 
                        " . ($last_name ? "'$last_name'" : "NULL") . ",
                        '$surname', '$date_of_birth', '$id', '$username',
                        " . ($email ? "'$email'" : "NULL") . ",
                        " . ($phone ? "'$phone'" : "NULL") . ",
                        '$password')
    ";

    try{
        mysqli_query($conn, $sql_add_user);
        header("Location: signin.php");
    }
    catch(Exception $e){
        if (str_contains($e->getMessage(), 'Duplicate entry')) {
        $error = "Duplicate entry!";
        }
        else {
            $error = "Could not register user. <br>Try again later!";
        }
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
        <h1>Welcome to LaBanca!</h1>
        <h2>Registration Form</h2>
        <form action="" method="post">
            <label for="first_name">First Name:</label> 
            <input type="text" name="first_name" id="first_name" placeholder="Joe" required> <br>

            <label for="last_name">Last Name:</label> 
            <input type="text" name="last_name" id="last_name" placeholder="William"> <br>  

            <label for="surname">Surname:</label>
            <input type="text" name="surname" id="surname" placeholder="Doe" required> <br><hr>

            <label for="date_of_birth">Date of Birth:</label> 
            <input type="date" name="date_of_birth" id="date_of_birth" required> <br>

            <label for="id">National ID No.:</label> 
            <input type="number" name="id" id="id" placeholder="88888888" required> <br> <hr>

            <label for="username">Username:</label> 
            <input type="text" name="username" id="username" placeholder="joedoe01" required> <br>

            <label for="email">Email Address:</label> 
            <input type="email" name="email" id="email" placeholder="example@email.com"> <br>

            <label for="phone">Phone Number:</label> 
            <input type="tel" name="phone" id="phone" placeholder="0712345678"> <br>

            <label for="password">Password:</label> 
            <input type="password" name="password" id="password" required> <br>

            <input type="submit" value="Submit" name="signup" id="submit">
            
            <!-- Google OAuth Divider -->
            <div class="oauth-divider">
                <span>or</span>
            </div>
            
            <!-- Google Sign Up Button -->
            <div id="g_id_onload"
                 data-client_id="YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com"
                 data-context="signup"
                 data-ux_mode="popup"
                 data-callback="handleGoogleSignUp"
                 data-auto_prompt="false">
            </div>
            
            <div class="g_id_signin"
                 data-type="standard"
                 data-shape="rectangular"
                 data-theme="outline"
                 data-text="signup_with"
                 data-size="large"
                 data-logo_alignment="left"
                 data-width="100%">
            </div>
            
            <div class="signin-link">
                Already registered? <a href="signin.php">Log in here</a>!
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
        // Handle Google Sign-Up response
        function handleGoogleSignUp(response) {
            console.log('Google Sign-Up Response:', response);
            
            // Send the Google credential token to your PHP backend
            fetch('google_oauth.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    credential: response.credential,
                    action: 'signup'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect to signin or dashboard
                    window.location.href = data.redirect || 'signin.php';
                } else {
                    // Show error message
                    alert(data.message || 'Registration failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred during registration');
            });
        }
    </script>
</body>
</html>

<?php
mysqli_close($conn);
?>