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
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banca Italiana - Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background: linear-gradient(135deg, #1a472a 0%, #2d5a3d 100%);
            color: #333;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        
        .header-banner {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .bank-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .bank-logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a472a;
            text-decoration: none;
        }
        
        .italian-flag {
            display: inline-block;
            width: 30px;
            height: 20px;
            background: linear-gradient(to right, #009246 33%, #fff 33% 66%, #ce2b37 66%);
            margin-left: 10px;
            vertical-align: middle;
            border: 1px solid #ddd;
        }
        
        .welcome-section {
            background: #fff;
            margin: 2rem auto;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .welcome-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            color: #1a472a;
            margin-bottom: 0.5rem;
        }
        
        .welcome-subtitle {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
        }
        
        .balance-card {
            background: linear-gradient(135deg, #1a472a, #2d5a3d);
            color: #fff;
            padding: 2rem;
            border-radius: 15px;
            margin: 2rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .balance-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="2"/></svg>');
            opacity: 0.3;
        }
        
        .balance-label {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }
        
        .balance-amount {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 600;
            margin: 0;
        }
        
        .currency-symbol {
            font-size: 2rem;
            vertical-align: super;
        }
        
        .transactions-section {
            background: #fff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-top: 2rem;
        }
        
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: #1a472a;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e0e0e0;
        }
        
        .transactions-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        
        .transactions-table th {
            background: #f8f9fa;
            color: #1a472a;
            font-weight: 600;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid #e0e0e0;
        }
        
        .transactions-table td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .transactions-table tr:hover {
            background: #f8f9fa;
        }
        
        .transaction-id {
            font-family: monospace;
            color: #666;
            font-size: 0.9rem;
        }
        
        .transaction-amount {
            font-weight: 500;
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 2rem 0;
        }
        
        .action-card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .action-card:hover {
            transform: translateY(-3px);
        }
        
        .action-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .italian-accent {
            color: #ce2b37;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="header-banner">
        <div class="container">
            <div class="bank-header">
                <a href="#" class="bank-logo">La Banca Italiana<span class="italian-flag"></span></a>
                <div style="color: #666;">Benvenuto, <?php echo $first_name . ' ' . $last_name; ?></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="welcome-section">
            <h1 class="welcome-title">Buongiorno, <?php echo $first_name; ?>!</h1>
            <p class="welcome-subtitle">Benvenuto nella tua <span class="italian-accent">Banca Italiana</span> - dove la tradizione incontra l'innovazione</p>
            
            <div class="balance-card">
                <div class="balance-label">Il tuo saldo attuale</div>
                <h2 class="balance-amount">
                    <span class="currency-symbol">€</span><?php echo number_format(check_balance($_SESSION['id']), 2); ?>
                </h2>
            </div>
        </div>

        //
        <div class="quick-actions">
            <div class="action-card">
                <div class="action-icon">💳</div>
                <h3>Trasferimenti</h3>
                <p>Invia denaro in sicurezza</p>
            </div>
            <div class="action-card">
                <div class="action-icon">📊</div>
                <h3>Investimenti</h3>
                <p>Fai crescere i tuoi risparmi</p>
            </div>
            <div class="action-card">
                <div class="action-icon">🏛️</div>
                <h3>Servizi Bancari</h3>
                <p>Gestisci il tuo conto</p>
            </div>
            <div class="action-card">
                <div class="action-icon">🤝</div>
                <h3>Consulenza</h3>
                <p>Parla con un esperto</p>
            </div>
        </div>

        <div class="transactions-section">
            <h2 class="section-title">Transazioni Recenti</h2>
            <table class="transactions-table">
                <thead>
                    <tr>
                        <th>ID Transazione</th>
                        <th>Data e Ora</th>
                        <th>Dettagli</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query_get_transactions = "SELECT * FROM transactions WHERE user_id = {$_SESSION['id']} ORDER BY time DESC LIMIT 10";
                        $results = mysqli_query($conn, $query_get_transactions);
                        if (mysqli_num_rows($results) > 0) {
                            while($transaction = mysqli_fetch_assoc($results)){
                                echo "<tr>";
                                echo "<td class='transaction-id'>TX_{$transaction['transaction_id']}</td>";
                                echo "<td>" . date('d/m/Y H:i', strtotime($transaction['time'])) . "</td>";
                                echo "<td class='transaction-amount'>{$transaction['message']}</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr>";
                            echo "<td colspan='3' style='text-align: center; color: #666; font-style: italic;'>Nessuna transazione recente</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
include("components/footer.php");
?>