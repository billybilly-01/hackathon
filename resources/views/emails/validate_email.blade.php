<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Confirmation</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #b6d1d3;
            font-family: Arial, sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
        }

        .header {
            padding: 20px 0 0 0;
            font-size: 24px;
            font-weight: bold;
            color: #f7b733;
            text-align: center;
        }

        .top-bar {
            padding: 10px 20px;
            text-align: right;
            font-size: 12px;
            color: #999;
        }

        .image-section {
            background-color: #b31717;
            padding: 30px;
        }

        .image-section img {
            max-width: 100px;
        }

        .content {
            padding: 0 0 30px;
        }

        .content h1 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #333;
        }

        .content p {
            font-size: 15px;
            color: #666;
            text-align: left;
            padding: 4px 0 0 23px;
        }

        .button {
            margin-top: 20px;
        }

        .button a {
            background-color: #f7b733;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
        }

        .footer {
            padding: 20px;
            font-size: 14px;
            color: #777;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            margin: 0 8px;
            display: inline-block;
            text-decoration: none;
        }

        .social-icons img {
            width: 24px;
        }
    </style>
</head>

<body>
    <div class="email-container" style="border: 2px solid #ccc; border-radius: 8px; overflow: hidden;">

        <div class="image-section">
            <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" alt="Envelope">
        </div>
        <div class="content">
            <div class="header">
                <h1>Félicitations votre candidature a été validéé 🎉</h1>
            </div>
            <div class="content">
                <h2>Bonjour {{ $candidat->prenom }},</h2>
                <p>
                    Merci pour votre inscription au <strong>{{ $eventName ?? "Hackathon HACKDAY'S 2025" }}</strong> !
                </p>
                <p>
                    📅 <strong>Date :</strong> {{ $eventDate ?? '15 juin 2025' }}<br>
                    📍 <strong>Lieu :</strong> {{ $eventLocation ?? "Siège Société Générale Côte d'Ivoire, Abidjan" }}
                </p>
                <p>
                    Nous sommes ravis de vous compter parmi nous. Vous recevrez prochainement plus d’informations sur les équipes, les thèmes et les lots à gagner.
                </p>

                <p>
                    Voici votre QR code d’identification :
                </p>
                <div style="margin: 20px 0;">
                    <img src="{{ $qrCodeBase64 }}" alt="QR Code" style="width:200px; height:200px;">
                </div>

                <p>
                    Si vous avez des questions, n’hésitez pas à nous contacter à <a href="mailto:{{ $contactEmail ?? 'contact@hackathon.com' }}">{{ $contactEmail ?? 'contact@hackathon.com' }}</a>.
                </p>
            </div>
            <div class="button">
                <a href="{{ $verificationUrl ?? '#' }}">Verify email address</a>
            </div>
        </div>
        <div class="footer" style="background-color:rgb(20, 20, 20); color: white;">
            <p>Stay in touch</p>
            <div class="social-icons">
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook"></a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter"></a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733553.png" alt="LinkedIn"></a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733614.png" alt="YouTube"></a>
            </div>
            <p style="margin-top: 10px; font-size: 12px;">
                Email envoyé par socgen<br>
                &copy; {{ date('Y') }} socgen Networks LTD. All rights reserved.
            </p>
        </div>
    </div>
</body>

</html>