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

            .header h1 {
                margin: 0;
                font-size: 24px;
            }

            .content {
                padding: 20px;
            }

            .content h2 {
                color: #003366;
                font-size: 20px;
                margin-bottom: 10px;
            }

            .content table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            .content th,
            .content td {
                text-align: left;
                padding: 12px;
                border: 1px solid #dddddd;
            }

            .content th {
                /* background-color: #f2d7d5; */
                color: #333333;
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
        <div class="email-container">
            <div class="header">
                <img src="{{ asset(env('APP_LOGO')) }}" alt="Logo">
            </div>
            <div class="content">
                <p>Dear {{ $user->first_name }} {{ $user->last_name }},</p>
                <p>We are pleased to inform you that your
                    {{ $transaction->direction->label() }}
                    transaction has been successfully completed. Below are
                    the details of your transaction:</p>
                <h3 style="text-align: center">Transaction Details</h3>

                <table>
                    <tr>
                        <th>Transaction ID</th>
                        <td>{{ $transaction->reference_id }}</td>
                    </tr>
                    <tr>
                        <th>Transaction Type</th>
                        <td>{{ $transaction->direction->label() }}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>{{ currency($user->currency) . formatAmount($transaction->amount) }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $transaction->description }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ date('jS M Y h:i:s A ', strtotime($transaction->transaction_at)) }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $transaction->status->label() }}</td>
                    </tr>
                </table>
                <p>Following this transaction, the balances on your account are as follows:</p>
                <table>
                    <tr>
                        <th>Available Balance</th>
                        <td>{{ currency($user->currency) }}{{ formatAmount($user->balance) }}</td>
                    </tr>
                </table>

                <p>If you have any questions or need further assistance, please do not hesitate to contact our support
                    team.</p>
                <p>Thanks for banking with us!</p>

            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
            </div>
        </div>
    </body>

</html>
