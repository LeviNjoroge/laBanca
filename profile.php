<?php
// to let users change their personal details or even delete their account
include("components/header.php");
$user_id = $_SESSION['id'];

if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: signin.php");
}
if (isset($_POST["delete_account"])) {
    echo "<script>alert('DELETING ACCOUNT')</script>";
    $sql_delete_all = "DELETE FROM users WHERE id = {$user_id}";
    mysqli_query($conn, $sql_delete_all);
    echo "<script>alert('ACCOUNT DELETED')</script>";
    session_destroy();
    header("Location: signin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBanca: Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<!--Change details-->
<div class="change_details">
    <h3>Edit Personal Information:</h3>
            <form action="" method="post">
            <label for="first_name">First Name:</label> 
            <input type="text" name="first_name" id="first_name" placeholder="Joe"> <br>

            <label for="last_name">Last Name:</label> 
            <input type="text" name="last_name" id="last_name" placeholder="William"> <br>  

            <label for="surname">Surname:</label>
            <input type="text" name="surname" id="surname" placeholder="Doe"> <br><hr>

            <label for="date_of_birth">Date of Birth:</label> 
            <input type="date" name="date_of_birth" id="date_of_birth"> <br>

            <label for="id">National ID No.:</label> 
            <input type="number" name="id" id="id" placeholder="88888888"> <br> <hr>

            <label for="username">Username:</label> 
            <input type="text" name="username" id="username" placeholder="joedoe01"> <br>

            <label for="email">Email Address:</label> 
            <input type="email" name="email" id="email" placeholder="example@email.com"> <br>

            <label for="phone">Phone Number:</label> 
            <input type="tel" name="phone" id="phone" placeholder="0712345678"> <br>

            <label for="password">Password:</label> 
            <input type="password" name="password" id="password"> <br>
        <input type="submit" value="Save Changes" id="submit"> <br><hr>
        </form>
</div>
<!--Delete account-->
    <form action="" method="post"><input type="submit" value="Delete Account!" name="delete_account" id="logout"></form><hr>
<!--Logout button-->
    <form action="" method="post"><input type="submit" value="logout!" name="logout" id="logout"></form><hr>
</body>
</html>