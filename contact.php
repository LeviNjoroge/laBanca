<?php
include("components/header.php");
if(isset($_POST['submit_comment'])) {
    $username = $_SESSION['username'];
    $telephone = $_SESSION['phone'];
    $email = $_SESSION['email'];
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
    submitReview($username, $telephone, $email, $message);
}
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
        <form action="" method="post">
            <div class="contact-form">
            <label for="message">Leave a review, comment, or query:</label> <br>
            <textarea name="message" id="message" placeholder="Write your message here..."></textarea> <br>
            <input type="submit" value="Submit" name="submit_comment" class="submit-comment" > <br>
        </div>
        </form>
        <div class="display_contacts">
            <h3>or reach us via...</h3>
            <p>Phone: <a href="tel:+254712345678" style="color: black; text-decoration: none;">+254712345678</a></p>
            <p>Email: <a href="mailto:support@labanca.com" style="color: black; text-decoration: none;">support@labanca.com</a></p>
            <p>Address: 123 Main Street, Rome, Italy</p>
        </div>
    </div>

<?php
include("components/footer.php");
?>