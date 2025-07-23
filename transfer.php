<?php
include("components/header.php");
$user_email = $_SESSION["email"];
$user_phone = $_SESSION["phone"];
$balance = $_SESSION["balance"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBanca: Money Transfer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!--Deposit Cash-->
    <form action="" method="post">
        <input type="submit" value="Deposit Cash" name="deposit_cash"> <br>
    </form>
</body>
</html>
<?php
include("components/footer.php");
?>