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

        echo "<script>alert('\${$amount} SUCCESSFULLY DEPOSITED')</script>";
    } catch (Exception $e) {
        echo "<script>alert('Was unable to deposit your money:(')</script>";
    }
}

// user can transfer cash to another user
function transfer_cash($from, $to, $amount){
    try {
        // first, ensure that the recepient exists
        $users = mysqli_query($GLOBALS['conn'], "SELECT id FROM users");
        $users = mysqli_fetch_assoc($users);
        if (in_array($to,$users)) {
            $query_transfer_cash = "
                                    UPDATE users SET balance = balance - {$amount} WHERE id = {$from};
                                    UPDATE users SET balance = balance + {$amount} WHERE id = {$to};

                                    INSERT INTO transactions(user_id, message) VALUES('{$from}','TRANSFERED \${$amount} TO USER_{$to}');
                                    INSERT INTO transactions(user_id, message) VALUES('{$to}','RECEIVED \${$amount} FROM USER_{$from}');
                                    ";
            mysqli_multi_query($GLOBALS['conn'], $query_transfer_cash);

            echo "<script>alert('\${$amount} SUCCESSFULLY TRANSFERED TO USER_{$to}')</script>";
        } else {
            echo "<script>alert('COULD NOT TRANSFER! RECEPIENT NOT FOUND!')</script>";

        }

        
    } catch (Exception $e) {
        echo "<script>alert('Was unable to transfer {$amount} to user_{$to}:(')</script>";
        throw $e;
    }
}

function withdraw_cash($user_id, $amount){
    try {
        $query_withdraw_cash = "UPDATE users SET balance = balance - {$amount} WHERE id = {$user_id}";
        mysqli_query($GLOBALS['conn'], $query_withdraw_cash);

        $query_record_withdrawal = "INSERT INTO transactions(user_id, message) VALUES('$user_id','WITHDREW \${$amount}')";
        mysqli_query($GLOBALS['conn'], $query_record_withdrawal);

        echo "<script>alert('\${$amount} SUCCESSFULLY WITHDRAWN!')</script>";
    } catch (Exception $e) {
        echo "<script>alert('Was unable to withdraw \${$amount}:(')</script>";
    }
}

function submitReview($username, $telephone, $email, $message){
    try {
        $query_record_review = "INSERT INTO reviews(username, email_address, telephone, message) VALUES('$username', '$email', '$telephone', '$message')";
        mysqli_query($GLOBALS['conn'], $query_record_review);
        echo "<script>alert('Review submitted successfully!')</script>";
    } catch (Throwable $th) {
        echo "<script>alert('Was unable to submit review:(')</script>";
        echo $th;
    }
}