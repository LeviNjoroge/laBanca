<?php
// the registration form
include("database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Demo</title>
</head>
<body>
    <div class="form-container">
        <h1>Welcome to JayBanca!</h1>
        <h2>Registration Form</h2>
        <form action="" method="post">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" placeholder="Joe" required>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" placeholder="William">

            <label for="surname">Surname:</label>
            <input type="text" name="surname" id="surname" placeholder="Doe" required>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" name="date_of_birth" id="date_of_birth" required>

            <label for="id">National ID No.:</label>
            <input type="number" name="id" id="id" placeholder="88888888" required>

            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="joedoe01" required>

            <label for="email">Email Address:</label>
            <input type="email" name="email" id="email" placeholder="example@email.com">

            <label for="phone">Phone Number:</label>
            <input type="tel" name="phone" id="phone" placeholder="0712345678">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" value="Submit" name="signup">
        </form>
    </div>
</body>
</html>


<?php

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
        header("Location: index.php");
    }
    catch(Exception $e){
        if (str_contains($e->getMessage(), 'Duplicate entry')) {
        echo "Duplicate entry!";
        }
        else {
            echo "Could not register user. <br>Try again later!";
        }
    }
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
}


mysqli_close($conn);
?>