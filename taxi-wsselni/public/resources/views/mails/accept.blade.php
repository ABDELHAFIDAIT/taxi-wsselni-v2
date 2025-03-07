<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Réservation - TaxiWsselni</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 2px solid #f3f4f6;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .logo-taxi { color: #f59e0b; }
        .logo-wsselni { color: #2563eb; }
        .content {
            padding: 20px 0;
        }
        .details {
            background-color: #f3f4f6;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 2px solid #f3f4f6;
            font-size: 14px;
            color: #666;
        }
        .button {
            display: inline-block;
            background-color: #2563eb;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="https://github.com/ABDELHAFIDAIT/taxi-wsselni/blob/main/taxi-wsselni/public/logo.png?raw=true" alt="Logo de TaxiWsselni" class="h-16">
        </div>
    </div>

    <div class="content">
        <h2>Confirmation de votre réservation</h2>
        
        <p>Bonjour {{ $passenger }},</p>
        
        <p>Votre réservation a été confirmée avec succès. Voici les détails de votre trajet :</p>
        
        <div class="details">
            <p><strong>Date et Heure :</strong> {{ $date }}</p>
            <p><strong>Ville de Départ :</strong> {{ $depart }}</p>
            <p><strong>Destination :</strong> {{ $destination }}</p>
            <p><strong>Chauffeur :</strong> {{ $driver }}</p>
            <p><strong>Véhicule :</strong> {{ $car }}</p>
        </div>

        <p>Si vous avez besoin de modifier ou d'annuler votre réservation, veuillez nous contacter au moins 2 heures avant l'heure prévue.</p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} TaxiWsselni. Tous droits réservés.</p>
        <p>Pour toute assistance, contactez-nous au +212 612345678</p>
    </div>
</body>
</html>
