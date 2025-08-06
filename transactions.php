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
            <button id="deposit_btn" onclick="openDialog('deposit_dialog')">
                <img src="images/deposit.png" alt="Deposit" width="70px" height="70px">
                <h2>Deposit Cash</h2>
                <p>Deposit cash into your account</p>
            </button>
            <button id="withdraw_btn" onclick="openDialog('withdraw_dialog')">
                <img src="images/cash-withdrawal.png" alt="Withdraw" width="70px" height="70px">
                <h2>Withdraw Cash</h2>
                <p>Withdraw cash from your account</p>
            </button>
            <button id="transfer_btn" onclick="openDialog('transfer_dialog')">
                <img src="images/money-transfer.png" alt="Transfer" width="70px" height="70px">
                <h2>Transfer Cash</h2>
                <p>Transfer cash to another user</p>
            </button>
        </div>
        
        <!--Deposit Cash-->
        <dialog id="deposit_dialog">
            <div class="form_wrapper">
                <form action="" method="post" class="transaction-form">
                    <h3>Deposit Cash</h3>
                    <label for="amount">Enter amount to deposit: </label>
                    <input type="number" name="deposit" id="deposit"> <br>
                    <input type="submit" value="Deposit Cash" name="deposit_cash" id="cash">
                    <button onclick="closeDialog()" class="close-btn" type="button">Cancel</button>
                </form>
            </div>
        </dialog>
        <!--Withdraw Cash-->
        <dialog id="withdraw_dialog">
            <div class="form_wrapper">
                <form action="" method="post" class="transaction-form">
                    <h3>Withdraw Cash</h3>
                    <label for="amount">Enter amount to withdraw: </label>
                    <input type="number" name="withdraw" id="withdraw"> <br>
                    <input type="submit" value="Withdraw Cash" name="withdraw_cash" id="cash">
                    <button onclick="closeDialog()" class="close-btn" type="button">Cancel</button>
                </form>
            </div>
        </dialog>
        <!--Transfer Cash-->
        <dialog id="transfer_dialog">
            <div class="form_wrapper">
                <form action="" method="post" class="transaction-form">
                    <h3>Transfer Cash</h3>
                    <label for="to">Enter user_id of the recipient: </label>
                    <input type="number" name="to" id="to"> <br>
                    <label for="amount">Enter amount to Transfer: </label>
                    <input type="number" name="transfer" id="transfer"> <br>
                    <input type="submit" value="Transfer Cash" name="transfer_cash" id="cash">
                    <button onclick="closeDialog()" class="close-btn" type="button">Cancel</button>
                </form>
            </div>
        </dialog>
    </div>
    <script>
        function openDialog(dialogId) {
            document.getElementById(dialogId).showModal();
        }
        
        function closeDialog() {
            // Close any open dialog
            // document.querySelectorAll("dialog").forEach(dialog => {
            //     if (dialog.open) {
                    dialog.close();
            //     }
            // });
        }
        
        // Add click-outside-to-close functionality to all dialogs
        document.querySelectorAll("dialog").forEach(dialog => {
            dialog.addEventListener("click", function(e) {
                const wrapper = this.querySelector(".form_wrapper");
                if (wrapper && !wrapper.contains(e.target)) {
                    this.close();
                }
            });
        });
    </script>
    <div class="footnotes" style="font-size: xx-small;">
        images used as icons on this page are from <a href="https://www.flaticon.com/free-icons/">Transaction icons created by Freepik - Flaticon</a>
    </div>
</body>
</html>
<?php
include("components/footer.php");
?>