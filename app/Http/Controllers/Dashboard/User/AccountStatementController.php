<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountStatementControllerStoreRequest;

class AccountStatementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['registeredUser']);
    }

    public function index()
    {
        $user = User::find(auth('user')->user()->id);

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Account Statement', 'url' => null, 'active' => true]
        ];

        $data = [
            'title' => 'Account Statement',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user
        ];

        return view('dashboard.user.account_statement.index', $data);
    }

    public function store(AccountStatementControllerStoreRequest $request)
    {
        $request->validated();

        try {
            $transactions = Transaction::whereBetween('transaction_at', [$request->from, $request->to])->get();

            if (count($transactions) > 0) {
                return redirect()->route('user.account_statement.show', [$request->from, $request->to]);
            }

            return redirect()->back()->with('error', 'No transactions were found for the selected date range');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function show($fromDate, $toDate)
    {
        $user = User::find(auth('user')->user()->id);

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Account Statement', 'url' => route('user.account_statement.index')],
            ['label' => 'Account Statement Details', 'url' => null, 'active' => true]
        ];

        try {
            $transactions = Transaction::where('user_id', $user->id)->whereBetween('transaction_at', [$fromDate, $toDate])->get();

            $totalAmount = 0;

            foreach ($transactions as $key => $transaction) {
                $totalAmount += $transaction->amount;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }

        $data = [
            'title' => 'Account Statement Details',
            'user' => $user,
            'breadcrumbs' => $breadcrumbs,
            'transactions' => $transactions,
            'totalAmount' => $totalAmount,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ];

        return view('dashboard.user.account_statement.show', $data);
    }

    public function download($fromDate, $toDate)
    {
        try {
            $user = User::find(auth('user')->user()->id);

            $transactions = Transaction::where('user_id', $user->id)->whereBetween('transaction_at', [$fromDate, $toDate])->get();

            $totalAmount = 0;

            foreach ($transactions as $key => $transaction) {
                $totalAmount += $transaction->amount;
            }

            $data = [
                'title' => 'Account Statement',
                'user' => $user,
                'transactions' => $transactions,
                'totalAmount' => $totalAmount,
                'fromDate' => $fromDate,
                'toDate' => $toDate,
            ];

            $name = 'account_statement_' . $fromDate . '_' . $toDate . '';

            $pdf = Pdf::loadView('pdf.account_statement', $data)->setPaper('A3');

            return match (config('app.env')) {
                'production' => $pdf->download($name),
                default => $pdf->stream($name),
            };
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
