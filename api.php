<?php
// to export all apis

include("database.php");

// check user's balance
function check_balance($id){
    $sql_check_balance = "SELECT balance FROM users WHERE id = {$id}";
    $result = mysqli_query($GLOBALS["conn"], $sql_check_balance);
    if (mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_assoc($result);
        return $row["balance"];
    }
    else{
        return 0;
    }
}

// user can deposit some amount
function deposit_cash($user_id, $amount){
    try {
        $query_update_deposited_amount = "UPDATE users SET balance = balance + {$amount} WHERE id = {$user_id}";
        mysqli_query($GLOBALS['conn'], $query_update_deposited_amount);

        $query_record_deposit = "INSERT INTO transactions(user_id, message) VALUES('{$user_id}','DEPOSITED \${$amount}')";
        mysqli_query($GLOBALS['conn'], $query_record_deposit);

        echo "<script>alert('You have successfully deposited \${$amount}')</script>";
    } catch (Exception $e) {
        echo "<script>alert('Was unable to deposit your money:(')</script>";
    }
}

// user can transfer cash to another user
function transfer_cash($from, $to, $amount){
    try {
        $query_transfer_cash = "
                                UPDATE users SET amount = amount - {$amount} WHERE id = {$from};
                                UPDATE users SET amount = amount + {$amount} WHERE id = {$to};
                                ";
        mysqli_query($GLOBALS['conn'], $query_transfer_cash);

        $query_update_transfer = "INSERT INTO transactions(user_id, message) VALUES('{$from}','TRANSFERED \${$amount} TO {$to}')";
        mysqli_query($GLOBALS['conn'], $query_update_transfer);

        echo "<script>alert('{$amount} SUCCESSFULLY TRANSFERED TO USER_{$to}')</script>";
    } catch (Exception $e) {
        echo "<script>alert('Was unable to transfer {$amount} to user_{$to}:(')</script>";
    }
}

function withdraw_cash($user_id, $amount){
    $query_withdraw_cash = "UPDATE users SET balance = balance - {$amount} WHERE id = {$user_id}";
    mysqli_query($GLOBALS['conn'], $query_withdraw_cash);

    $query_record_withdrawal = "INSERT INTO transactions(user_id, message) VALUES('$user_id','WITHDRAWAL OF \${$amount} WAS SUCCESSFUL')";
}