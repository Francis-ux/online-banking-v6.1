<?php

use App\Http\Controllers\Dashboard\User\AccountStatementController;
use App\Http\Controllers\Dashboard\User\CardController;
use App\Http\Controllers\Dashboard\User\DepositController;
use App\Http\Controllers\Dashboard\User\EmailVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\User\HomeController;
use App\Http\Controllers\Dashboard\User\IdentityVerificationController;
use App\Http\Controllers\Dashboard\User\InternationalTransferController;
use App\Http\Controllers\Dashboard\User\LoanController;
use App\Http\Controllers\Dashboard\User\LocalTransferController;
use App\Http\Controllers\Dashboard\User\NotificationController;
use App\Http\Controllers\Dashboard\User\ProfileController;
use App\Http\Controllers\Dashboard\User\TransactionController;
use App\Http\Controllers\Dashboard\User\TransactionReceiptController;
use App\Http\Controllers\Dashboard\User\TransferPinController;

Route::middleware('user')->prefix('user')->group(function () {
    Route::get('/dashboard', HomeController::class)->name('user.dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('user.profile.update');

    Route::get('/transfer/pin/create', [TransferPinController::class, 'index'])->name('user.transfer_pin.index');
    Route::post('/transfer/pin/store', [TransferPinController::class, 'store'])->name('user.transfer_pin.store');

    Route::get('/identity/verification', [IdentityVerificationController::class, 'index'])->name('user.identity_verification.index');
    Route::post('/identity/verification/store', [IdentityVerificationController::class, 'store'])->name('user.identity_verification.store');

    Route::get('/deposit', [DepositController::class, 'index'])->name('user.deposit.index');
    Route::get('/deposit/{deposit}', [DepositController::class, 'create'])->name('user.deposit.create');
    Route::get('/deposit/show/{deposit}', [DepositController::class, 'show'])->name('user.deposit.show');
    Route::post('/deposit/card/store/', [DepositController::class, 'cardStore'])->name('user.deposit.card.store');
    Route::post('/deposit/bitcoin/store/', [DepositController::class, 'bitcoinStore'])->name('user.deposit.bitcoin.store');

    Route::get('/notification', [NotificationController::class, 'index'])->name('user.notification.index');
    Route::get('/notification/show/{notification}', [NotificationController::class, 'show'])->name('user.notification.show');
    Route::get('/notification/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('user.notification.mark_all_as_read');

    Route::get('/email/verification', [EmailVerificationController::class, 'index'])->name('user.email.verification.index');
    Route::post('/email/verification/store', [EmailVerificationController::class, 'store'])->name('user.email.verification.store');
    Route::get('/email/verification/resend', [EmailVerificationController::class, 'resend'])->name('user.email.verification.resend');

    Route::get('/loan', [LoanController::class, 'index'])->name('user.loan.index');
    Route::post('/loan/store', [LoanController::class, 'store'])->name('user.loan.store');
    Route::get('/loan/show/{loan}', [LoanController::class, 'show'])->name('user.loan.show');
    Route::get('/loan/repay/{loan}', [LoanController::class, 'repay'])->name('user.loan.repay');

    Route::get('/transaction', [TransactionController::class, 'index'])->name('user.transaction.index');
    Route::get('/transaction/show/{transaction}', [TransactionController::class, 'show'])->name('user.transaction.show');
    Route::get('/transaction/download/{transaction}', [TransactionController::class, 'download'])->name('user.transaction.download');

    Route::get('/card', [CardController::class, 'index'])->name('user.card.index');
    Route::get('/card/apply', [CardController::class, 'create'])->name('user.card.create');
    Route::post('/card/store', [CardController::class, 'store'])->name('user.card.store');
    Route::get('/card/show/{card}', [CardController::class, 'show'])->name('user.card.show');
    Route::patch('/card/activate/{card}', [CardController::class, 'activate'])->name('user.card.activate');
    Route::patch('/card/deactivate/{card}', [CardController::class, 'deactivate'])->name('user.card.deactivate');
    Route::patch('/card/limit/{card}', [CardController::class, 'setLimit'])->name('user.card.setLimit');

    Route::get('/international/transfer', [InternationalTransferController::class, 'index'])->name('user.international_transfer.index');
    Route::post('/international/transfer/store', [InternationalTransferController::class, 'store'])->name('user.international_transfer.store');
    Route::get('/international/transfer/verify/{transferReferenceId}/{orderNo}', [InternationalTransferController::class, 'verify'])->name('user.international_transfer.verify');
    Route::post('/international/transfer/verify/code/{transferReferenceId}/{orderNo}', [InternationalTransferController::class, 'verifyCode'])->name('user.international_transfer.verify_code');
    Route::get('/international/transfer/approve/success/{transferReferenceId}', [InternationalTransferController::class, 'approveSuccess'])->name('user.international_transfer.approve_success');
    Route::get('/international/transfer/success/{transferReferenceID}', [InternationalTransferController::class, 'success'])->name('user.international_transfer.success');

    Route::get('/local/transfer', [LocalTransferController::class, 'index'])->name('user.local_transfer.index');
    Route::get('/local/transfer/get/account/number/', [LocalTransferController::class, 'getAccountNumber'])->name('user.local_transfer.get_account_number');
    Route::post('/local/transfer/store', [LocalTransferController::class, 'store'])->name('user.local_transfer.store');
    Route::get('/local/transfer/verify/{transferReferenceId}/{orderNo}', [LocalTransferController::class, 'verify'])->name('user.local_transfer.verify');
    Route::post('/local/transfer/verify/code/{transferReferenceId}/{orderNo}', [LocalTransferController::class, 'verifyCode'])->name('user.local_transfer.verify_code');
    Route::get('/local/transfer/approve/success/{transferReferenceId}', [LocalTransferController::class, 'approveSuccess'])->name('user.local_transfer.approve_success');
    Route::get('/local/transfer/success/{transfer}', [LocalTransferController::class, 'success'])->name('user.local_transfer.success');

    Route::get('/transaction-receipt/download/{transactionReceipt}', [TransactionReceiptController::class, 'download'])->name('user.transaction_receipt.download');

    Route::get('/account/statement', [AccountStatementController::class, 'index'])->name('user.account_statement.index');
    Route::post('/account/statement/store', [AccountStatementController::class, 'store'])->name('user.account_statement.store');
    Route::get('/account/statement/show/{from}/{to}', [AccountStatementController::class, 'show'])->name('user.account_statement.show');
    Route::get('/account/statement/download/{from}/{to}', [AccountStatementController::class, 'download'])->name('user.account_statement.download');
});
