<?php
include("components/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBanca: Contact Us</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="content">
        <h2 style="font-size: 2rem;">Contact Us</h2>
        <div class="contact-form">
            <label for="tel">Telephone Number:</label>
            <input type="tel" name="tel" id="tel" value="<?php echo $_SESSION['phone']??'N/A'?>" style="width:min-content;" size="13"> <br>
            <label for="tel">Email Address:</label>
            <input type="email" name="email" id="email" value="<?php echo $_SESSION['phone']??'N/A'?>" style="width:min-content;" size="13"> <br>
            <label for="message">Leave a review, comment, or query:</label> <br>
            <textarea name="message" id="message" placeholder="Write your message here..."></textarea> <br>
            <input type="submit" value="Submit" name="submit-comment" class="submit-comment"> <br>
        </div>
        <div class="display_contacts">
            <h3>Reach us via...</h3>
            <p>Phone: <a href="tel:+254712345678" style="color: black; text-decoration: none;">+254712345678</a></p>
            <p>Email: <a href="mailto:support@labanca.com" style="color: black; text-decoration: none;">support@labanca.com</a></p>
            <p>Address: 123 Main Street, Rome, Italy</p>
        </div>
    </div>

<?php
include("components/footer.php");
?>