<?php


$first_name= $_SESSION['first_name'];
$last_name= $_SESSION['last_name'];

include("api.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBanca</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include("components/header.php")?>
    <h1>Hi <?php echo $first_name?>!</h1>

</body>
</html>
