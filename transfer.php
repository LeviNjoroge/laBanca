<?php
include("components/header.php");
$user_email = $_SESSION["email"];
$user_phone = $_SESSION["phone"];
$balance = $_SESSION["balance"];

if (isset($_POST['deposit_cash'])) {
    $deposit_amount = filter_input(INPUT_POST, 'deposit', FILTER_VALIDATE_INT);
    deposit_cash($_SESSION['id'], $deposit_amount);
}
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
        <label for="amount">Enter amount to deposit: </label>
        <input type="number" name="deposit" id="deposit">
        <input type="submit" value="Deposit Cash" name="deposit_cash" id="cash"> <br>
    </form>
</body>
</html>
<?php
include("components/footer.php");
?>