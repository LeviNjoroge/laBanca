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