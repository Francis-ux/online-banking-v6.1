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

            .container {
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

            .header h1 {
                margin: 0;
                font-size: 24px;
            }

            .content {
                padding: 20px;
            }

            .content dl {
                margin: 0 0 20px;
            }

            .content dt {
                font-weight: bold;
                color: #333333;
                margin-bottom: 5px;
            }

            .content dd {
                margin: 0 0 15px 15px;
                color: #333333;
                line-height: 1.6;
            }

            .content p {
                color: #333333;
                line-height: 1.6;
            }

            .footer {
                background-color: #f5f5f5;
                color: #333333;
                padding: 10px;
                text-align: center;
                font-size: 0.9em;
                border-top: 1px solid #dddddd;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="header">
                <img src="{{ asset(env('APP_LOGO')) }}" alt="Logo">
            </div>
            <div class="content">
                <p>Dear {{ $user->first_name }} {{ $user->last_name }},</p>
                <p>Your card has been {{ $action }}. Below are the details:</p>
                <dl>
                    <dt>Reference ID</dt>
                    <dd>{{ $card->reference_id }}</dd>
                    <dt>Type</dt>
                    <dd>{{ $card->type->label() }}</dd>
                    <dt>Card Number</dt>
                    <dd>**** **** **** {{ substr($card->card_number, -4) }}</dd>
                    <dt>Status</dt>
                    <dd>{{ $card->status->label() }}</dd>
                    @if ($card->issued_at)
                        <dt>Issued At</dt>
                        <dd>{{ $card->issued_at->format('d M Y') }}</dd>
                    @endif
                </dl>
                <p>Thank you for using {{ env('APP_NAME') }}!</p>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
            </div>
        </div>
    </body>

</html>
