<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransferCode extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'code',
        'verification_code_id',
        'transfer_reference_id',
        'order_no',
    ];

    public function createTransferCode($referenceId, $user)
    {
        $verificationCodes = VerificationCode::all();

        $orderNo = 1;

        if (!empty($verificationCodes)) {
            foreach ($verificationCodes as $verificationCode) {
                if ($verificationCode->nature_of_code == "alnum") {

                    $transferCode = generateTransferCode($verificationCode->length, true);
                } else {

                    $transferCode = generateTransferCode($verificationCode->length, false);
                }

                if ($verificationCode->applicable_to == "All") {

                    $transferCodeData = [
                        'uuid'                  => str()->uuid(),
                        'code'                  => $transferCode,
                        'verification_code_id'  => $verificationCode->id,
                        'transfer_reference_id' => $referenceId,
                        'user_id'               => $user->id,
                        'order_no'              => $orderNo++
                    ];

                    TransferCode::create($transferCodeData);
                } elseif ($verificationCode->applicable_to == $user->id) {

                    $transferCodeData = [
                        'uuid'                  => str()->uuid(),
                        'code'                  => $transferCode,
                        'verification_code_id'  => $verificationCode->id,
                        'transfer_reference_id' => $referenceId,
                        'user_id'               => $user->id,
                        'order_no'              => $orderNo++
                    ];

                    TransferCode::create($transferCodeData);
                }
            }
        }
    }
    public function transfer()
    {
        return $this->belongsTo(Transfer::class, 'transfer_reference_id', 'reference_id');
    }

    public function verificationCode()
    {
        return $this->belongsTo(VerificationCode::class);
    }
    public function getTransferVerificationData($referenceId)
    {
        $query = DB::table('transfer_codes')
            ->select('transfer_codes.*', 'transfers.*', 'verification_codes.*')
            ->join('transfers', 'transfers.reference_id', '=', 'transfer_codes.transfer_reference_id')
            ->join('verification_codes', 'verification_codes.id', '=', 'transfer_codes.verification_code_id')
            ->where('transfer_codes.transfer_reference_id', $referenceId)
            ->get();

        return $query;
    }
}
