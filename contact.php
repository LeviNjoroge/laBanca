<?php
include("components/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBanca: Contact Us</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="contact-form">
        <h2>Contact Us</h2>
        <label for="message">Leave a review, comment, or query:</label> <br>
        <textarea name="message" id="message" placeholder="Write your message here..."></textarea> <br>
        <input type="submit" value="submit" name="submit-comment"> <br>
    </div>
<?php
include("components/footer.php");
?>