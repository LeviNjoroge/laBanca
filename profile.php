<?php
// to let users change their personal details or even delete their account
include("components/header.php");
$user_username = $_SESSION['username'];
$user_first_name = $_SESSION['first_name'];
$user_last_name = $_SESSION['last_name'];
$user_id = $_SESSION['id'];
$user_id_no = $_SESSION['id_no'];
$user_surname = $_SESSION['surname'];
$user_email = $_SESSION['email'];
$user_date_of_birth = $_SESSION['date_of_birth'];
$user_phone = $_SESSION['phone'];
$user_profile_picture = $_SESSION['profile_picture'];

// logout of account
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: signin.php");
}

// delete account
if (isset($_POST["delete_account"])) {
    echo "<script>alert('DELETING ACCOUNT')</script>";
    $sql_delete_all = "DELETE FROM users WHERE id = {$user_id}";
    mysqli_query($conn, $sql_delete_all);
    echo "<script>alert('ACCOUNT DELETED')</script>";
    session_destroy();
    header("Location: signin.php");
}

// show profile picture
// if(file_exists("profile_picture_images/".$user_profile_picture)){
//     $profile_picture = "profile_picture_images/".$user_profile_picture;
//     } else{
//     $profile_picture= "profile_picture_images/default.jpeg";
// } 

// change profile picture
if (isset($_POST["change_profile_pic"])) {
    $file = $_FILES["profile_picture"];
    $file_name_partitioned = explode('.',$file['name']);
    $file_extextension = strtolower(end($file_name_partitioned));
    $accepted_extenstions = array('jpg', 'png', 'jpeg');

    if($file['error']){
        $error = "There was an error uploading your file! Please try again later.";
    } else{
        if (!in_array($file_extextension, $accepted_extenstions)) {
            $error = "Invalid file type!";
        } else{
            if ($file['size'] > 5*1000*1000) { // 5MB or less
                $error = "File too large to upload!";
            } else{
                $current_file_location = $file['tmp_name'];
                $new_file_name = $user_id .".". $file_extextension;
                $new_file_location = "profile_picture_images/" . $new_file_name;
                // file_
                move_uploaded_file($current_file_location, $new_file_location);
                try { // updating file name in dtb
                    $query_update_file_name = "UPDATE users SET profile_picture = '$new_file_name' WHERE id = '$user_id'";
                    mysqli_query($conn, $query_update_file_name);
                    $success = "Image uploaded successfully!\nLogin to see changes.";
                } catch (Exception $e) {
                    $error = "There was an error updating your file!";
                }
            }
        }
    }
}

// update profile details
if (isset($_POST['submit_changes'])) {
    if (!empty($_POST['first_name'])) {
        try {
            $first_name = filter_input(INPUT_POST,'first_name',FILTER_SANITIZE_SPECIAL_CHARS);
            $query_update_first_name = "UPDATE users SET first_name = '$first_name' WHERE id = '$user_id'";
            mysqli_query($conn, $query_update_first_name);
        } catch (Exception $e) {
            $error = "Unable to update profile!";
        }
    }
    if (!empty($_POST['last_name'])) {
        try {
            $last_name = filter_input(INPUT_POST,'last_name',FILTER_SANITIZE_SPECIAL_CHARS);
            $query_update_last_name = "UPDATE users SET last_name = '$last_name' WHERE id = '$user_id'";
            mysqli_query($conn, $query_update_last_name);
        } catch (Exception $e) {
            $error = "Unable to update profile!";
        }
    }
    if (!empty($_POST['username'])) {
        try {
            $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS);
            $query_update_username = "UPDATE users SET username = '$username' WHERE id = '$user_id'";
            mysqli_query($conn, $query_update_username);
        } catch (Exception $e) {
            $error = "Unable to update profile!";
        }
    }
    if (!empty($_POST['date_of_birth'])) {
        try {
            $date_of_birth = $_POST['date_of_birth'];
            $query_update_date_of_birth = "UPDATE users SET date_of_birth = '$date_of_birth' WHERE id = '$user_id'";
            mysqli_query($conn, $query_update_date_of_birth);
        } catch (Exception $e) {
            $error = "Unable to update profile!";
        }
    }
    if (!empty($_POST['surname'])) {
        try {
            $surname = filter_input(INPUT_POST,'surname',FILTER_SANITIZE_SPECIAL_CHARS);
            $query_update_surname = "UPDATE users SET surname = '$surname' WHERE id = '$user_id'";
            mysqli_query($conn, $query_update_surname);
        } catch (Exception $e) {
            $error = "Unable to update profile!";
        }
    }
    if (!empty($_POST['id'])) {
        try {
            $id = $_POST['id'];
            $query_update_id = "UPDATE users SET national_id_no = '$id' WHERE id = '$user_id'";
            mysqli_query($conn, $query_update_id);
        } catch (Exception $e) {
            $error = "Unable to update profile!";
        }
    }
    if (!empty($_POST['email'])) {
        try {
            $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
            $query_update_email = "UPDATE users SET email_address = '$email' WHERE id = '$user_id'";
            mysqli_query($conn, $query_update_email);
        } catch (Exception $e) {
            $error = "Unable to update profile!";
        }
    }
    if (!empty($_POST['phone'])) {
        try {
            $phone = filter_input(INPUT_POST,'phone',FILTER_SANITIZE_SPECIAL_CHARS);
            $query_update_phone = "UPDATE users SET phone_number = '$phone' WHERE id = '$user_id'";
            mysqli_query($conn, $query_update_phone);
        } catch (Exception $e) {
            $error = "Unable to update profile!";
        }
    }
    if (!empty($_POST['password'])) {
        if ($_POST['password'] === $_POST['confirm_password']) {
            try {
                $password = $_POST['password'];
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $query_update_password = "UPDATE users SET password = '$hash' WHERE id = '$user_id'";
                mysqli_query($conn, $query_update_password);
            } catch (Exception $e) {
                $error = "Unable to update profile!";  
            }
        } else {
            $error = "Passwords dont match, couldn't update profile";
        }
        
    }

    // log message to user
    if (isset($error)) {
        $message = $error;
    } else {
        $message = "Your profile has been updated successfully!\nLogin to view changes.";
    }
    echo "<script>alert(" . json_encode($message) . ");</script>";
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
        <img src="<?php echo "profile_picture_images/".$user_profile_picture?>" alt="Profile Picture NOT Found" id="profile_picture_img"> <br>
        <label for="profile_picture">Change/Add Profile Picture: </label> 
        <input type="file" name="profile_picture" id="profile_picture" accept=".jpg, .png, .jpeg" style="border-bottom: none; width:auto">
        <input type="submit" value="Change Profile Picture" name="change_profile_pic" style="border-bottom: none; width:auto; background-color: rgba(0,0,0,0.1); "> <br>
        <?php if (isset($error)) {
            echo "<script>alert('{$error}')</script>";
        }elseif (isset($success)) {
            echo "<script>alert(" . json_encode($success) . ")</script>";
        }
        ?>
    </form>

    <form action="" method="post" style="input{width:auto;}">
        <label for="first_name">First Name:</label> 
        <input type="text" name="first_name" id="first_name" placeholder="<?php echo $user_first_name?>"> <br>

        <label for="last_name">Last Name:</label> 
        <input type="text" name="last_name" id="last_name" placeholder="<?php echo $user_last_name?>"> <br>  

        <label for="surname">Surname:</label>
        <input type="text" name="surname" id="surname" placeholder="<?php echo $user_surname?>"> <br><hr>

        <label for="date_of_birth">Date of Birth:</label> 
        <input type="date" name="date_of_birth" id="date_of_birth" placeholder="<?php echo $user_date_of_birth?>" style="width:auto;"> <br>

        <label for="id">National ID No.:</label> 
        <input type="number" name="id" id="id" placeholder="<?php echo $user_id_no?>"> <br> <hr>

        <label for="username">Username:</label> 
        <input type="text" name="username" id="username" placeholder="<?php echo $user_username?>"> <br>

        <label for="email">Email Address:</label> 
        <input type="email" name="email" id="email" placeholder="<?php echo $user_email?>"> <br>

        <label for="phone">Phone Number:</label> 
        <input type="tel" name="phone" id="phone" placeholder="<?php echo $user_phone?>"> <br>

        <label for="password">Password:</label> 
        <input type="password" name="password" id="password"> <br>

        <label for="password">Confirm Password:</label> 
        <input type="password" name="confirm_password" id="confirm_password"> <br>

        <input type="submit" value="Save Changes" id="submit" name="submit_changes"> <br><hr>
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