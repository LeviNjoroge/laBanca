<?php
// to export all apis

include("database.php");

function check_balance($id){

    $sql_check_balance = "SELECT balance FROM users WHERE user_id = {$id}";
    $result = mysqli_query($GLOBALS["conn"], $sql_check_balance);

    if (mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_assoc($result);
        return $row["balance"];
    }
    else{
        return 0;
    }
}

function update_user_profile($user_id){
    while (true) {
        $new_users_values = array(
            "first_name" => "first_name",
            "last_name" => "last_name",
            "surname" => "surname",
            "username" => "username",
            "date_of_birth" => "date_of_birth",
            "national_id_no" => "id",
            "email_address" => "email",
            "phone_number" => "phone",
            "password" => "password"
        );
        if (!empty($_POST[$new_users_values['key']])) {
            if ($new_users_values['key'] == "password") {
                if ($_POST['password'] === $_POST['confirm_password']) {
                    try {
                        $query_update_values = "UPDATE users SET {$new_users_values['key']} = 'filter_input(INPUT_POST,'{$new_users_values['value']}',FILTER_SANITIZE_SPECIAL_CHARS)' WHERE id = '$user_id'";
                        mysqli_query($GLOBALS['conn'], $query_update_values);
                        return "Profile successfully updated";
                    } catch (Exception $e) {
                        return "Unable to update profile!";
                    }
                } else {
                    return "Passwords do not match!";
                }
            } else{
                try {
                    $query_update_values = "UPDATE users SET {$new_users_values['key']} = 'filter_input(INPUT_POST,'{$new_users_values['value']}',FILTER_SANITIZE_SPECIAL_CHARS)' WHERE id = '$user_id'";
                    mysqli_query($GLOBALS['conn'], $query_update_values);
                    return "Profile successfully updated";
                } catch (Exception $e) {
                    return "Unable to update profile!";
                }
            }
        }
    }

}
?>