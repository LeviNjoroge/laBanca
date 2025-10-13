<?php

// was trying API
require "credentials.php";

$url = "https://api.freecurrencyapi.com/v1/latest?apikey={$API_KEY}";

// initialize curl
$curl = curl_init($url);

// return response instead of printing
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// execute curl
$resp = curl_exec($curl);

// check for errors
if(curl_errno($curl)){
    echo "Curl error: " . curl_error($curl);
}

curl_close($curl);

// decode response
$resp_array = json_decode($resp, true);

// get the "data" part
$data = $resp_array['data'];

// dump to check
var_dump($data);

// Example: loop through currencies
echo "<h3>Currency Rates</h3><ul>";
foreach ($data as $currency => $rate) {
    echo "<li>$currency : $rate</li>";
}
echo "</ul>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency exchanges</title>
</head>
<body>
    <h1>Currency Exchanges</h1>
    <p>Below are the currency pair trading values against USD</p>
    <table>
        <thead>

        </thead>
        <tbody>
            <?php
                
            ?>
        </tbody>
    </table>
</body>
</html>