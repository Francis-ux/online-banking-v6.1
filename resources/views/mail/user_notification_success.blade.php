<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 600px;
                margin: 20px auto;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .header {
                background-color: #003366;
                color: #ffffff;
                padding: 20px;
                text-align: center;
            }

            .logo {
                text-align: center;
                margin-bottom: 20px;
            }

            .logo img {
                max-width: 300px;
            }

            .content {
                padding: 30px;
                color: #333;
            }

            h2 {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 24px;
                margin-bottom: 20px;
            }

            p {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 16px;
                margin-bottom: 20px;
                line-height: 1.5;
            }

            .button {
                display: inline-block;
                padding: 12px 24px;
                background-color: #4CAF50;
                color: #fff;
                text-decoration: none;
                border-radius: 4px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 16px;
            }

            .button:hover {
                background-color: #45a049;
            }

            .footer {
                background-color: #f5f5f5;
                padding: 20px;
                text-align: center;
                font-size: 14px;
                color: #777;
                line-height: 1.5;
            }

            .footer p {
                margin: 0;
            }

            .footer .contact-info {
                margin-top: 10px;
            }

            .footer .contact-info a {
                color: #777;
                text-decoration: none;
            }

            .signature {
                margin-top: 30px;
                text-align: center;
                font-style: italic;
                color: #888;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
        </style>
    </head>

    <body>
        <div class='container'>
            <div class='header'>
                <div class='logo'>
                    <img src='{{ asset(env('APP_LOGO')) }}' alt='Logo'>
                </div>
            </div>
            <div class='content'>
                <p>Hello {{ $user->first_name }} {{ $user->last_name }},</p>
                <p>{{ $notification->message }}</p>
                <p>If you have any questions or need further assistance, please feel free to contact us.</p>
            </div>
            <div class='footer'>
                <p>Thanks you for banking with us!</p>
                <div class='contact-info'>
                    <p>Contact us:</p>
                    <p><a href='tel:{{ env('APP_PHONE') }}'>{{ env('APP_PHONE') }}</a> | <a
                            href='mailto: {{ env('APP_EMAIL') }} '> {{ env('APP_EMAIL') }} </a></p>
                </div>
            </div>
        </div>
    </body>

</html>
