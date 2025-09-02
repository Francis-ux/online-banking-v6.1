<?php

namespace App\Enum;

enum NotificationType: string
{
    case Deposit = 'deposit';
    case Withdrawal = 'withdrawal';
    case Transfer = 'transfer';
    case Payment = 'payment';
    case AccountUpdate = 'account_update';
    case LoanApplication = 'loan_application';
    case LoanApproved = 'loan_approved';
    case LoanRejected = 'loan_rejected';
    case LoanRepaid = 'loan_repaid';
    case CardRequested = 'card_requested';
    case CardIssued = 'card_issued';
    case CardActivated = 'card_activated';
    case CardDeactivated = 'card_deactivated';
    case CardBlocked = 'card_blocked';

    public function label(): string
    {
        return match ($this) {
            self::Deposit => 'Deposit',
            self::Withdrawal => 'Withdrawal',
            self::Transfer => 'Transfer',
            self::Payment => 'Payment',
            self::AccountUpdate => 'Account Update',
            self::LoanApplication => 'Loan Application',
            self::LoanApproved => 'Loan Approved',
            self::LoanRejected => 'Loan Rejected',
            self::LoanRepaid => 'Loan Repaid',
            self::CardRequested => 'Card Request',
            self::CardIssued => 'Card Issued',
            self::CardActivated => 'Card Activated',
            self::CardDeactivated => 'Card Deactivated',
            self::CardBlocked => 'Card Blocked',
        };
    }
}
