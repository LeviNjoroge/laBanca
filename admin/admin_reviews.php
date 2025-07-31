<?php
include("admin_header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laBanca Reviews</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <h1>Reviews</h1>
    <div class="reviews">
        <table class="show_records">
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
                                echo "<td>TX_{$transaction['transaction_id']}</td>";
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
include("$_SERVER[DOCUMENT_ROOT]/components/footer.php");
?>