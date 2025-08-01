<?php
include("admin_header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laBanca Reviews</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <h1>Reviews</h1>
    <div class="reviews">
        <table class="show_records">
            <thead>
                <tr>
                    <th colspan="4" style="text-align:center">REVIEWS</th>
                </tr>
                <tr>
                    <th>Username</th>
                    <th>Email Address</th>
                    <th>Telephone Number</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        $query_get_reviews = "SELECT * FROM reviews ORDER BY time DESC";
                        $results = mysqli_query($GLOBALS['conn'], $query_get_reviews);
                        if (mysqli_num_rows($results) > 0) {
                            while($review = mysqli_fetch_assoc($results)){
                                echo "<tr>";
                                echo "<td>{$review['username']}</td>";
                                echo "<td>{$review['email_address']}</td>";
                                echo "<td>{$review['telephone']}</td>";
                                echo "<td>{$review['message']}</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<td>N/A</td>";
                            echo "<td>N/A</td>";
                            echo "<td>N/A</td>";
                            echo "<td>N/A</td>";
                        }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
include("$_SERVER[DOCUMENT_ROOT]/components/footer.php");
?>