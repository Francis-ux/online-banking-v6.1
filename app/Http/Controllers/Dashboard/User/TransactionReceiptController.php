<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class TransactionReceiptController extends Controller
{
    public function __construct()
    {
        $this->middleware(['registeredUser']);
    }

    public function download(string $uuid)
    {
        try {
            $user = User::find(auth('user')->user()->id);

            $transaction = $user->transactions()->where('uuid', $uuid)->first();

            $transfer = $transaction->transfer;

            $name = 'TransactionReceipt';

            $data = [
                'user' => $user,
                'transaction' => $transaction,
                'transfer' => $transfer
            ];

            $pdf = Pdf::loadView('pdf.transaction', $data);

            if (config('app.env') == 'production') {
                return $pdf->download($name);
            } else {
                return $pdf->stream($name);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
