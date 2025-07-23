<?php
// to export all apis

include("database.php");

function check_balance($id){
    $sql_check_balance = "SELECT balance FROM users WHERE id = {$id}";
    $result = mysqli_query($GLOBALS["conn"], $sql_check_balance);
    if (mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_assoc($result);
        return $row["balance"] ?? 0;
    }
    else{
        return "0.00";
    }
}

function deposit_cash($user_id, $amount){
    try {
        $query_update_deposited_amount = "UPDATE users SET balance = balance + {$amount} WHERE id = {$user_id}";
        mysqli_query($GLOBALS['conn'], $query_update_deposited_amount);
        $query_record_deposit = "INSERT INTO transactions(user_id, message) VALUES('{$user_id}','DEPOSITED \${$amount}')";
        mysqli_query($GLOBALS['conn'], $query_record_deposit);
        echo "<script>alert('You have successfully deposited \${$amount}')</script>";
    } catch (Exception $e) {
        echo "<script>alert('Was unable to deposit you money:(')</script>";
        throw $e;
    }
}