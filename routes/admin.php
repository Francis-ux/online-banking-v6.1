<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\HomeController;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\Admin\ProfileController;
use App\Http\Controllers\Dashboard\Admin\SettingController;
use App\Http\Controllers\Dashboard\Admin\UserCardController;
use App\Http\Controllers\Dashboard\Admin\UserLoanController;
use App\Http\Controllers\Dashboard\Admin\UserDepositController;
use App\Http\Controllers\Dashboard\Admin\UserWithdrawalController;
use App\Http\Controllers\Dashboard\Admin\UserTransactionController;
use App\Http\Controllers\Dashboard\Admin\UserNotificationController;
use App\Http\Controllers\Dashboard\Admin\UserVerificationController;
use App\Http\Controllers\Dashboard\Admin\VerificationCodeController;
use App\Http\Controllers\Dashboard\Admin\UserAccountSettingController;
use App\Http\Controllers\Dashboard\Admin\UserTransactionReceiptController;
use App\Http\Controllers\Dashboard\Admin\UserIdentityVerificationController;

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', HomeController::class)->name('admin.dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');

    Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/user/show/{id}', [UserController::class, 'show'])->name('admin.user.show');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');

    Route::get('/user/verification/set/{id}', [UserVerificationController::class, 'set'])->name('admin.user.verification.set');
    Route::get('/user/verification/skip/{id}', [UserVerificationController::class, 'skip'])->name('admin.user.verification.skip');

    Route::get('/user/account/setting/{id}', [UserAccountSettingController::class, 'index'])->name('admin.user.account.setting.index');
    Route::post('/user/account/setting/update{id}', [UserAccountSettingController::class, 'update'])->name('admin.user.account.setting.update');

    Route::get('/user/identity/verification/{id}', [UserIdentityVerificationController::class, 'index'])->name('admin.user.identity.verification.index');
    Route::post('/user/identity/verification/store/{id}', [UserIdentityVerificationController::class, 'store'])->name('admin.user.identity.verification.store');

    Route::get('/user/deposit/{id}', [UserDepositController::class, 'index'])->name('admin.user.deposit.index');
    Route::get('/user/deposit/show/{id}/{deposit}', [UserDepositController::class, 'show'])->name('admin.user.deposit.show');
    Route::post('/user/deposit/confirm/{id}/{deposit}', [UserDepositController::class, 'confirm'])->name('admin.user.deposit.confirm');
    Route::get('/user/deposit/delete/{id}/{deposit}', [UserDepositController::class, 'delete'])->name('admin.user.deposit.delete');

    Route::get('/user/notification/{id}', [UserNotificationController::class, 'index'])->name('admin.user.notification.index');
    Route::get('/user/notification/show/{id}/{notification}', [UserNotificationController::class, 'show'])->name('admin.user.notification.show');
    Route::get('/user/notification/delete/{id}/{notification}', [UserNotificationController::class, 'delete'])->name('admin.user.notification.delete');
    Route::get('/user/notification/send/{id}', [UserNotificationController::class, 'send'])->name('admin.user.notification.send');
    Route::post('/user/notification/send/store/{id}', [UserNotificationController::class, 'sendStore'])->name('admin.user.notification.send.store');

    Route::get('/user/transaction/{id}', [UserTransactionController::class, 'index'])->name('admin.user.transaction.index');
    Route::post('/user/transaction/store/{id}', [UserTransactionController::class, 'store'])->name('admin.user.transaction.store');
    Route::get('/user/transaction/show/{id}/{transaction}', [UserTransactionController::class, 'show'])->name('admin.user.transaction.show');
    Route::get('/user/transaction/delete/{id}/{transaction}', [UserTransactionController::class, 'delete'])->name('admin.user.transaction.delete');

    Route::get('/user/loan/{id}', [UserLoanController::class, 'index'])->name('admin.user.loan.index');
    Route::get('/user/show/{id}/{loan}', [UserLoanController::class, 'show'])->name('admin.user.loan.show');
    Route::get('/user/approve/{id}/{loan}', [UserLoanController::class, 'approve'])->name('admin.user.loan.approve');
    Route::get('/user/reject/{id}/{loan}', [UserLoanController::class, 'reject'])->name('admin.user.loan.reject');

    Route::get('/user/card/{id}', [UserCardController::class, 'index'])->name('admin.user.card.index');
    Route::get('/user/card/show/{id}/{card}', [UserCardController::class, 'show'])->name('admin.user.card.show');
    Route::get('/user/card/issue/{id}/{card}', [UserCardController::class, 'issue'])->name('admin.user.card.issue');
    Route::get('/user/card/block/{id}/{card}', [UserCardController::class, 'block'])->name('admin.user.card.block');

    Route::get('/verification/code', [VerificationCodeController::class, 'index'])->name('admin.verification.code.index');
    Route::get('/verification/code/create', [VerificationCodeController::class, 'create'])->name('admin.verification.code.create');
    Route::post('/verification/code/store', [VerificationCodeController::class, 'store'])->name('admin.verification.code.store');
    Route::get('/verification/code/show/{code}', [VerificationCodeController::class, 'show'])->name('admin.verification.code.show');
    Route::get('/verification/code/edit/{code}', [VerificationCodeController::class, 'edit'])->name('admin.verification.code.edit');
    Route::post('/verification/code/update/{code}', [VerificationCodeController::class, 'update'])->name('admin.verification.code.update');
    Route::get('/verification/code/delete/{code}', [VerificationCodeController::class, 'delete'])->name('admin.verification.code.delete');

    Route::get('/user/withdrawal/{id}', [UserWithdrawalController::class, 'index'])->name('admin.user.withdrawal.index');
    Route::get('/user/withdrawal/show/{id}/{withdrawal}', [UserWithdrawalController::class, 'show'])->name('admin.user.withdrawal.show');
    Route::get('/user/withdrawal/delete/{id}/{withdrawal}', [UserWithdrawalController::class, 'delete'])->name('admin.user.withdrawal.delete');

    Route::get('/user/transaction-receipt/download/{id}/{transactionReceipt}', [UserTransactionReceiptController::class, 'download'])->name('admin.user.transaction_receipt.download');

    Route::get('/setting', [SettingController::class, 'index'])->name('admin.setting.index');
    Route::post('/setting/update', [SettingController::class, 'update'])->name('admin.setting.update');
});
