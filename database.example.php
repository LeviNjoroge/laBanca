<?php
// database configuration

/*
HOW TO CONFIGURE
1. Create a database on your hosting server($db_host)
2. Give it a name that you will use in the $db_name below
3. User your server database credentials here as username: $db_user and password: $db_pass
*/

$db_host = "YOUR_HOST_NAME_HERE";
$db_user = "YOUR_USER_NAME_HERE";
$db_pass = "YOUR_PASSWORD_HERE";
$db_name = "YOUR_DATABASE_NAME_HERE";

try{
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
}
catch(Exception $e){
    echo "<h1>Warning! Could not connect to database!</h1><br>";
}
?>