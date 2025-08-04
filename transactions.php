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
        <div class="dialog_buttons">
            <button id="deposit-btn" onclick="openDialog('deposit_dialog')">Deposit Cash</button>
            <button id="withdraw-btn" onclick="openDialog('withdraw_dialog')">Withdraw Cash</button>
            <button id="transfer-btn" onclick="openDialog('transfer_dialog')">Transfer Cash</button>
        </div>
        
        <!--Deposit Cash-->
        <dialog id="deposit_dialog">
            <form action="" method="post" class="transaction-form">
            <h3>Deposit Cash</h3>
            <label for="amount">Enter amount to deposit: </label>
            <input type="number" name="deposit" id="deposit"> <br>
            <input type="submit" value="Deposit Cash" name="deposit_cash" id="cash">
            <button onclick="closeDialog()">Close</button>
        </form>
        </dialog>
        <!--Withdraw Cash-->
        <dialog id="withdraw_dialog">
        <form action="" method="post" class="transaction-form">
            <h3>Withdraw Cash</h3>
            <label for="amount">Enter amount to withdraw: </label>
            <input type="number" name="withdraw" id="withdraw"> <br>
            <input type="submit" value="Withdraw Cash" name="withdraw_cash" id="cash">
            <button onclick="closeDialog()">Close</button>
        </form>
        </dialog>
        <!--Transfer Cash-->
        <dialog id="transfer_dialog">
        <form action="" method="post" class="transaction-form">
            <h3>Transfer Cash</h3>
            <label for="to">Enter user_id of the recipient: </label>
            <input type="number" name="to" id="to"> <br>
            <label for="amount">Enter amount to Transfer: </label>
            <input type="number" name="transfer" id="transfer"> <br>
            <input type="submit" value="Transfer Cash" name="transfer_cash" id="cash">
            <button onclick="closeDialog()">Close</button>
        </form>
        </dialog>
    </div>
    <script>
        function openDialog(dialogId) {
            document.getElementById(dialogId).showModal();
        }
        function closeDialog() {
            document.querySelector("dialog").close();
        }
    </script>
</body>
</html>
<?php
include("components/footer.php");
?>