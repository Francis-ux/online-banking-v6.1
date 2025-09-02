<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f5f5f5;
            }

            .email-container {
                max-width: 600px;
                margin: 20px auto;
                background-color: #ffffff;
                border: 1px solid #dddddd;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .header {
                background-color: #003366;
                color: #ffffff;
                padding: 20px;
                text-align: center;
            }

            .header img {
                max-width: 300px;
                margin-bottom: 10px;
            }

            .content {
                padding: 20px;
            }

            .content h2 {
                color: #003366;
                font-size: 20px;
                margin-bottom: 10px;
            }

            .content p {
                color: #333333;
                line-height: 1.6;
                margin-bottom: 10px;
            }

            .pin-box {
                margin: 20px 0;
                padding: 15px;
                background-color: #f0f8ff;
                border: 1px dashed #003366;
                border-radius: 6px;
                font-size: 18px;
                font-weight: bold;
                color: #003366;
                text-align: center;
            }

            .footer {
                background-color: #f5f5f5;
                color: #333333;
                padding: 10px;
                text-align: center;
                font-size: 0.9em;
                border-top: 1px solid #dddddd;
            }

            .footer a {
                color: #003366;
                text-decoration: none;
            }
        </style>
    </head>

    <body>
        <div class="email-container">
            <div class="header">
                <img src="{{ asset(env('APP_LOGO')) }}" alt="{{ env('APP_NAME') }} Logo">
            </div>
            <div class="content">
                <p>Hello {{ $user->first_name }} {{ $user->last_name }},</p>

                <p>Your transfer PIN has been reset by our support team as requested.</p>

                <!-- Show new PIN -->
                <div class="pin-box">
                    Your new Transfer PIN: <br>
                    <span>{{ $newTransferPin }}</span>
                </div>

                <p>For your security, please log in to your account and change this PIN immediately after your next
                    login.</p>
                <p>If you did not request this reset, please contact our support team immediately.</p>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
            </div>
        </div>
    </body>

</html>
