<?php
session_start();
if (empty($_SESSION['id'])) {
    header("Location: /signin.php");
}
$user_profile_picture = $_SESSION['profile_picture'];

// if(file_exists("profile_picture_images/".$user_profile_picture)){
//     $profile_picture = "profile_picture_images/".$user_profile_picture;
//     }
//     else{
//         $profile_picture= "profile_picture_images/default.jpeg";
//     } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        header{
            background-color: rgba(204, 203, 203, 1);
            border-bottom: 1px solid gray;
        }
        nav{
            padding: 5px;
            top: 0px;
        }

        #nav-links{
            vertical-align: middle;
            top: 0px;
            margin-right: 10%;
            color: rgb(43, 43, 43);
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
        }

        #nav-links:active{
            border-bottom: 1px solid black;
            color:rgb(145, 145, 145)
        }

        #img_profile_pic {
            height: 60px;
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 5px;
            
        }


        #nav-profile{
            margin-right: 12%;
            color: rgba(94, 93, 93, 1);
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="/profile.php" id="nav-profile"><img src="<?php echo "/profile_picture_images/".$user_profile_picture?>" id="img_profile_pic"> <?php echo $_SESSION["username"]?> </a>
            <a href="admin.php" id="nav-links">Home</a>
            <a href="admin_transactions.php" id="nav-links">Money Transactions</a>
            <a href="admin_reviews.php" id="nav-links">Reviews</a>
            <a href="admin_profile.php" id="nav-links">Profile</a>
        </nav>
    </header>
</body>
</html>