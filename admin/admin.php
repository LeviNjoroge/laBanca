<?php
include("admin_header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBanca</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <h1>Hi ADMIN!</h1>
    <p>
        Welcome to the admin panel. <br>
        Here, you can manage all your users' accounts, transactions and reviews left by them. <br>
        You can also manage your own account. <br>
        Below, you can view the users registered in LaBanca.
    </p>

</body>
<?php
include("$_SERVER[DOCUMENT_ROOT]/components/footer.php");
foreach ($_SESSION as $key => $value) {
    echo $key . ": " . $value . "<br>";
}
?>
