<?php
// database configuration

//

$db_server = "YOUR_SERVER_NAME_HERE";
$db_host = "YOUR_HOST_NAME_HERE";
$db_pass = "YOUR_PASSWORD_HERE";
$db_name = "YOUR_DATABASE_NAME_HERE";

try{
    $conn = mysqli_connect($db_server, $db_host, $db_pass, $db_name);
}
catch(Exception $e){
    echo "<h1>Warning! Could not connect to database!</h1><br>";
}
?>