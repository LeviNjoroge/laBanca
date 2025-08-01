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
    <div class="content">
    <h1>Hi ADMIN!</h1>
    <p>
        Welcome to the admin panel. <br>
        Here, you can manage all your users' accounts, transactions and reviews left by them. <br>
        You can also manage your own account. <br>
        Below, you can view the users registered in LaBanca.
    </p>
    <div class="table_wrap">
        <table class="show_records" border="1">
        <thead>
            <tr><th colspan="11" style="text-align:center">Users</th></tr>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Surname</th>
                <th>Date of Birth</th>
                <th>National ID No.</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Date of Registration</th>
                <th>Account Balance</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT * FROM users WHERE username != 'admin'";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['surname'] . "</td>";
                    echo "<td>" . $row['date_of_birth'] . "</td>";
                    echo "<td>" . $row['national_id_no'] . "</td>";
                    echo "<td>" . $row['email_address'] . "</td>";
                    echo "<td>" . $row['phone_number'] . "</td>";
                    echo "<td>" . $row['date_of_registration'] . "</td>";
                    echo "<td>" . $row['balance'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    </div>
    </div>
</body>
<?php
include("$_SERVER[DOCUMENT_ROOT]/components/footer.php");
?>
