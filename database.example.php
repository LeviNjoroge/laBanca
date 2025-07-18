<?php
// database configuration

//

$db_host = "YOUR_HOST_NAME_HERE";
$db_user = "YOUR_USER_NAME_HERE";
$db_pass = "YOUR_PASSWORD_HERE";
$db_name = "YOUR_DATABASE_NAME_HERE";

try{
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    mysqli_conn
}
catch(Exception $e){
    echo "<h1>Warning! Could not connect to database!</h1><br>";
}
?>