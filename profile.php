<?php
// to let users change their personal details or even delete their account
include("components/header.php");
$user_username = $_SESSION['username'];
$user_first_name = $_SESSION['first_name'];
$user_last_name = $_SESSION['last_name'];
$user_id = $_SESSION['id'];
$user_surname = $_SESSION['surname'];
$user_email = $_SESSION['email'];
$user_phone = $_SESSION['phone'];
$user_balance = $_SESSION['balance'];


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
            <input type="text" name="first_name" id="first_name" placeholder="<?php echo $user_first_name?>"> <br>

            <label for="last_name">Last Name:</label> 
            <input type="text" name="last_name" id="last_name" placeholder="<?php echo $user_last_name?>"> <br>  

            <label for="surname">Surname:</label>
            <input type="text" name="surname" id="surname" placeholder="<?php echo $user_surname?>"> <br><hr>

            <label for="date_of_birth">Date of Birth:</label> 
            <input type="date" name="date_of_birth" id="date_of_birth" placeholder="<?php echo $user_date_of_birth?>"> <br>

            <label for="id">National ID No.:</label> 
            <input type="number" name="id" id="id" placeholder="<?php echo $user_id?>"> <br> <hr>

            <label for="username">Username:</label> 
            <input type="text" name="username" id="username" placeholder="<?php echo $user_username?>"> <br>

            <label for="email">Email Address:</label> 
            <input type="email" name="email" id="email" placeholder="<?php echo $user_first_name?>"> <br>

            <label for="phone">Phone Number:</label> 
            <input type="tel" name="phone" id="phone" placeholder="<?php echo $user_first_name?>"> <br>

            <label for="password">Password:</label> 
            <input type="password" name="password" id="password"> <br>

            <label for="password">Confirm Password:</label> 
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