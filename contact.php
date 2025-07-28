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
    <h2 style="font-size: 2rem;">Contact Us</h2>
    <div class="contact-form">
        <label for="message">Leave a review, comment, or query:</label> <br>
        <textarea name="message" id="message" placeholder="Write your message here..."></textarea> <br>
        <input type="submit" value="Submit" name="submit-comment" class="submit-comment"> <br>
    </div>
    <div class="display_contacts"></div>
<?php
include("components/footer.php");
?>