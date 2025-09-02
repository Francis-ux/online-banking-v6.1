<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Transaction Receipt</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }

            .receipt-container {
                width: 600px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #ccc;
                position: relative;
                overflow: hidden;
                /* Keep the watermarks inside the container */
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 2px solid #000;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }

            .header h1 {
                font-size: 18px;
                margin: 0;
            }

            .bank-logo img {
                height: 30px;
                float: right;
                margin-top: -25px
            }

            .receipt-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            .receipt-table tr {
                border-bottom: 1px solid #ccc;
            }

            .receipt-table .label {
                font-weight: bold;
                width: 30%;
                padding: 8px 0;
            }

            .receipt-table td {
                padding: 8px 0;
                vertical-align: top;
            }

            .footer {
                background-color: #d32f2f;
                color: #fff;
                text-align: center;
                padding: 10px;
                margin-top: 20px;
            }

            .footer p {
                margin: 5px 0;
            }

            /* Watermark in multiple positions */
            .watermark {
                position: absolute;
                font-size: 36px;
                /* Slightly reduced font size */
                color: rgba(211, 47, 47, 0.1);
                font-family: Arial, sans-serif;
                font-weight: bold;
                white-space: nowrap;
                z-index: 0;
                /* Ensure watermark is below other content */
                pointer-events: none;
                /* Ensure watermark doesn’t interfere with interactions */
                transform: rotate(-45deg);
                /* Diagonal rotation */
            }

            .watermark-0 {
                top: 0%;
                left: -10%;
            }

            .watermark-1 {
                top: 10%;
                left: 15%;
            }

            .watermark-2 {
                top: 20%;
                left: 30%;
            }

            .watermark-3 {
                top: 50%;
                left: 25%;
            }

            .watermark-4 {
                top: 70%;
                left: 55%;
            }

            .watermark-5 {
                top: 90%;
                left: 10%;
            }

            .watermark-6 {
                top: 85%;
                left: 75%;
            }
        </style>
    </head>

    <body>
        <div class="receipt-container">
            <!-- Watermarks -->
            <div class="watermark watermark-0">{{ env('APP_NAME') }}</div>
            <div class="watermark watermark-1">{{ env('APP_NAME') }}</div>
            <div class="watermark watermark-2">{{ env('APP_NAME') }}</div>
            <div class="watermark watermark-3">{{ env('APP_NAME') }}</div>
            <div class="watermark watermark-4">{{ env('APP_NAME') }}</div>
            <div class="watermark watermark-5">{{ env('APP_NAME') }}</div>
            <div class="watermark watermark-6">{{ env('APP_NAME') }}</div>

            <div class="header">
                <h1>TRANSACTION RECEIPT</h1>
                <div class="bank-logo">
                    <img src="{{ public_path(env('APP_LOGO')) }}" alt="{{ env('APP_NAME') }}">
                </div>
            </div>

            <table class="receipt-table">
                <tr>
                    <td class="label">Reference ID:</td>
                    <td>{{ $transaction->reference_id }}</td>
                </tr>
                <tr>
                    <td class="label">Transaction Type:</td>
                    <td>{{ $transaction->type->label() }}</td>
                </tr>
                <tr>
                    <td class="label">Transaction Direction:</td>
                    <td>{{ $transaction->direction->label() }}</td>
                </tr>
                <tr>
                    <td class="label">Transaction Date:</td>
                    <td>{{ date('jS M Y h:i A', strtotime($transaction->transaction_at)) }}</td>
                </tr>
                @if (!empty($transfer))
                    <tr>
                        <td class="label">{{ $transaction->direction->label() }}ed Account:</td>
                        <td>{{ $transfer->account_number }}</td>
                    </tr>
                    <tr>
                        <td class="label">Beneficiary Name:</td>
                        <td>{{ $transfer->account_name }}</td>
                    </tr>
                    <tr>
                        <td class="label">Beneficiary Bank:</td>
                        <td>{{ $transfer->bank_name }}</td>
                    </tr>
                @else
                    <tr>
                        <td class="label">{{ $transaction->direction->label() }}ed Account:</td>
                        <td>{{ $user->account_number }}</td>
                    </tr>
                    <tr>
                        <td class="label">Beneficiary Name:</td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="label">Description:</td>
                    <td>{{ $transaction->description }}</td>
                </tr>
                <tr>
                    <td class="label">Transaction Status:</td>
                    <td>
                        {{ $transaction->status->label() }}
                    </td>
                </tr>
                <tr>
                    <td class="label">Amount:</td>
                    <td>{{ formatAmount($transaction->amount) }} {{ currency($user->currency, 'code') }}</td>
                </tr>
                @if (!empty($transfer))
                    <tr>
                        <td class="label">Sender:</td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    </tr>
                @else
                @endif
            </table>

            <div class="footer">
                <p>For any other assistance you can always contact us on this email: {{ env('APP_EMAIL') }}</p>
                <p>Thank you.</p>
            </div>
        </div>
    </body>

</html>
