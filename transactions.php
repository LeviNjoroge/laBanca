<?php
include("components/header.php");
$user_email = $_SESSION["email"];
$user_phone = $_SESSION["phone"];
$balance = $_SESSION["balance"];

if (isset($_POST['deposit_cash'])) {
    $deposit_amount = filter_input(INPUT_POST, 'deposit', FILTER_VALIDATE_INT);
    deposit_cash($_SESSION['id'], $deposit_amount);
}

if (isset($_POST['withdraw_cash'])) {
    $withdrawal_amount = filter_input(INPUT_POST, 'withdraw', FILTER_VALIDATE_INT);
    withdraw_cash($_SESSION['id'], $withdrawal_amount);
}

if (isset($_POST['transfer_cash'])) {
    $recipient = filter_input(INPUT_POST, 'to', FILTER_VALIDATE_INT);
    $transfer_amount = filter_input(INPUT_POST, 'transfer', FILTER_VALIDATE_INT);
    transfer_cash($_SESSION['id'],$recipient, $transfer_amount);
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
    <div class="transactions content">
        <h1>Transactions</h1>
        <!--Deposit Cash-->
        <button id="deposit-btn" onclick="openDialog()">Deposit Cash</button>
        <dialog>
            <form action="" method="post" class="transaction-form">
            <h3>Deposit Cash</h3>
            <label for="amount">Enter amount to deposit: </label>
            <input type="number" name="deposit" id="deposit"> <br>
            <input type="submit" value="Deposit Cash" name="deposit_cash" id="cash"> <br>
        </form>
        </dialog>
        <hr>
        <!--Withdraw Cash-->
        <button id="withdraw-btn" onclick="openDialog()">Withdraw Cash</button>
        <dialog>
        <form action="" method="post" class="transaction-form">
            <h3>Withdraw Cash</h3>
            <label for="amount">Enter amount to withdraw: </label>
            <input type="number" name="withdraw" id="withdraw"> <br>
            <input type="submit" value="Withdraw Cash" name="withdraw_cash" id="cash"> <br>
        </form>
        </dialog>
        <hr>
        <!--Transfer Cash-->
        <button id="transfer-btn" onclick="openDialog()">Transfer Cash</button>
        <dialog>
        <form action="" method="post" class="transaction-form">
            <h3>Transfer Cash</h3>
            <label for="to">Enter user_id of the recipient: </label>
            <input type="number" name="to" id="to"> <br>
            <label for="amount">Enter amount to Transfer: </label>
            <input type="number" name="transfer" id="transfer"> <br>
            <input type="submit" value="Transfer Cash" name="transfer_cash" id="cash"> <br>

        </form>
        </dialog>
        <hr>
    </div>
    <script>
        function openDialog() {
            document.querySelector("dialog").showModal();
            document.getElementById("deposit-btn").style.display = "none";
            document.getElementById("withdraw-btn").style.display = "none";
            document.getElementById("transfer-btn").style.display = "none";
        }
        function closeDialog() {
            
        }
    </script>
</body>
</html>
<?php
include("components/footer.php");
?>