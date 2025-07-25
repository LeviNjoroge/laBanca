<?php
/* 
This page will host the following:
    A greeting + the second name of the user
    their current balance
    recent transactons
*/
include("components/header.php");
$first_name= $_SESSION['first_name'];
$last_name= $_SESSION['last_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBanca</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Hi <?php echo $first_name?>!</h1>
    <div class="acc_summary">
        <h3>Here is a summary of your account...</h3>
        <p title="if not updated, please log in again!">
            Your current balance is: <?php echo number_format(check_balance($_SESSION['id']),2); ?>
        </p>
        <!-- <h3 style="border-bottom: 2px solid gray;">Here are your recent transactions:</h3> -->
        <table class="display_transactions" border="1px">
            <thead>
                <tr>
                    <th colspan="3" style="text-align:center">RECENT TRANSACTIONS</th>
                </tr>
                <tr>
                    <th>Transaction ID</th>
                    <th>Time</th>
                    <th>Transaction</th>
                    <!-- <th>Balance</th> -->
                </tr>
            </thead>
            <tbody>
                    <?php
                        $query_get_transactions = "SELECT * FROM transactions WHERE user_id = {$_SESSION['id']} ORDER BY time DESC LIMIT 25";
                        $results = mysqli_query($conn, $query_get_transactions);
                        if (mysqli_num_rows($results) > 0) {
                            while($transaction = mysqli_fetch_assoc($results)){
                                echo "<tr>";
                                echo "<td>TRANSACTION_{$transaction['transaction_id']}</td>";
                                echo "<td>{$transaction['time']}</td>";
                                echo "<td>{$transaction['message']}</td>";
                                // echo "<td>transaction['balance']</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<td>N/A</td>";
                            echo "<td>N/A</td>";
                            echo "<td>N/A</td>";
                        }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
include("components/footer.php");
?>