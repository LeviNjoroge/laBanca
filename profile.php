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
$user_profile_picture = $_SESSION['profile_picture'];


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
if(file_exists("profile_picture_images/{$user_profile_picture}")){
    $profile_picture = "profile_picture_images/{$user_profile_picture}";
}
else{
    $profile_picture= "profile_picture_images/default.jpeg";
} 

if (isset($_POST["submit"])) {
    $file = $_FILES["profile_picture"];
    $filename = $_FILES["name"];
    echo $filename;
}

if (isset($_POST["change_profile_pic"])) {
    $file = $_FILES["profile_picture"];
    $file_extextension = strtolower(end(explode('.',$file['name'])));
    $accepted_extenstions = array('jpg', 'png', 'jpeg');

    if($file['error']){
        $error = "There was an error apploading your file! Please try again later.";
    } else{
        if (!in_array($file_extextension, $accepted_extenstions)) {
            $error = "Invalid file type!";
        } else{
            if ($file['size'] > 5*1000*1000) { // 5MB or less
                $error = "File too large to upload!";
            } else{
                $current_file_location = $file['tmp_name'];
                $new_file_name = $user_id .".". $file_extextension;
                $new_file_location = "profile_picture_images/"
            }
        }
    }
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
        <form action="" method="post" enctype="multipart/form-data">
            <img src="<?php echo $profile_picture?>" alt="Profile Picture NOT Found" id="profile_picture_img"> <br>
            <label for="profile_picture">Change/Add Profile Picture: </label> 
            <input type="file" name="profile_picture" id="profile_picture" accept=".jpg, .png, .jpeg" style="border-bottom: none; width:auto">
            <input type="submit" value="Change Profile Picture" name="change_profile_pic" style="border-bottom: none; width:auto; background-color: rgba(0,0,0,0.1); "> <br>
        </form>
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
            <input type="email" name="email" id="email" placeholder="<?php echo $user_email?>"> <br>

            <label for="phone">Phone Number:</label> 
            <input type="tel" name="phone" id="phone" placeholder="<?php echo $user_phone?>"> <br>

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

<?php
include("components/footer.php");
?>