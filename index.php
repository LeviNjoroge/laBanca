<?php
/* 
This page will host the following:
    A greeting + the second name of the user
    their current balance
    recent transactons
*/
include("components/header.php");
$first_name= $_SESSION['first_name'];
$last_name= $_SESSION['last_name'];
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
    <h1>Hi <?php echo $first_name?>!</h1>
    <div class="acc_summary">
        <h3>Here is a summary of your account...</h3>
        <p title="if not updated, please log in again!">
            Your current balance is: <?php echo check_balance($_SESSION['id'])?>
            
        </p>
        
    </div>
</body>
</html>
<?php
include("components/footer.php");
?>