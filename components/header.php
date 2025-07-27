<?php
session_start();
include("api.php");
if (empty($_SESSION['id'])) {
    header("Location: /signin.php");
}
$user_profile_picture = $_SESSION['profile_picture'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background: #ffffff;
            border-bottom: 1px solid #e5e5e5;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #000;
            font-weight: 600;
            font-size: 1.25rem;
            font-family: 'Inter', sans-serif;
        }

        .nav-brand:hover {
            color: #333;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: #666;
            text-decoration: none;
            font-weight: 400;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            position: relative;
        }

        .nav-links a:hover {
            color: #000;
            background: #f8f8f8;
        }

        .nav-links a.active {
            color: #000;
            background: #f0f0f0;
        }

        .nav-profile {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .nav-profile:hover {
            background: #f8f8f8;
            border-color: #e5e5e5;
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 0.75rem;
            border: 2px solid #e5e5e5;
            transition: border-color 0.2s ease;
        }

        .nav-profile:hover .profile-pic {
            border-color: #ccc;
        }

        .username {
            font-size: 0.9rem;
            color: #666;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            nav {
                padding: 0 1rem;
                flex-wrap: wrap;
                height: auto;
                min-height: 70px;
            }

            .nav-links {
                order: 3;
                width: 100%;
                justify-content: center;
                padding: 1rem 0;
                gap: 1rem;
                flex-wrap: wrap;
            }

            .nav-brand {
                font-size: 1.1rem;
            }

            .nav-links a {
                font-size: 0.9rem;
                padding: 0.4rem 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .nav-links {
                gap: 0.5rem;
            }
            
            .nav-links a {
                font-size: 0.85rem;
                padding: 0.3rem 0.6rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="/index.php" class="nav-brand">LaBanca</a>
            
            <ul class="nav-links">
                <li><a href="/index.php">Home</a></li>
                <li><a href="/transactions.php">Transactions</a></li>
                <li><a href="/contact.php">Contact</a></li>
                <li><a href="/profile.php">Profile</a></li>
            </ul>

            <a href="/profile.php" class="nav-profile">
                <img src="<?php echo "profile_picture_images/".$user_profile_picture?>" alt="Profile" class="profile-pic">
                <span class="username"><?php echo $_SESSION["username"]?></span>
            </a>
        </nav>
    </header>
</body>
</html>