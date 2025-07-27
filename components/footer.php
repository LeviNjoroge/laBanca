<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        footer {
            background: #ffffff;
            border-top: 1px solid #919191ff;
            margin-top: auto;
            padding: 2rem 0;
            font-family: 'Inter', sans-serif;
            background-color: rgba(204, 203, 203, 1);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-info {
            display: flex;
            align-items: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .copyright {
            color: #666;
            font-size: 0.9rem;
            font-weight: 400;
        }

        .developer-credit {
            color: #666;
            font-size: 0.9rem;
            font-weight: 400;
        }

        .developer-credit a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }

        .developer-credit a:hover {
            color: #000;
            background: #f8f8f8;
        }

        .footer-brand {
            color: #333;
            font-weight: 600;
            font-size: 1rem;
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .footer-links a {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 400;
            transition: all 0.2s ease;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }

        .footer-links a:hover {
            color: #000;
            background: #f8f8f8;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
                padding: 0 1rem;
            }

            .footer-info {
                flex-direction: column;
                gap: 1rem;
            }

            .footer-links {
                justify-content: center;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 480px) {
            footer {
                padding: 1.5rem 0;
            }

            .footer-links {
                gap: 1rem;
            }

            .copyright,
            .developer-credit,
            .footer-links a {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <footer>
        <div class="footer-content">
            <div class="footer-info">
                <span class="footer-brand">LaBanca</span>
                <span class="copyright">&copy; <?php echo date("Y")?></span>
                <span class="developer-credit">
                    Designed and Developed by 
                    <a href="https://www.linkedin.com/in/levinjorogejr/" target="_blank" rel="noopener noreferrer">
                        Levi Njoroge Junior
                    </a>
                </span>
            </div>
            
            <div class="footer-links">
                <a href="/contact.php">Support</a>
                <a href="#privacy">Privacy</a>
                <a href="#terms">Terms</a>
            </div>
        </div>
    </footer>
</body>
</html>