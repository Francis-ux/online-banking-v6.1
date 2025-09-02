<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\Card;
use App\Models\User;
use App\Enum\CardType;
use App\Models\Setting;
use App\Enum\CardStatus;
use App\Models\Transaction;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Enum\TransactionType;
use App\Enum\NotificationType;
use App\Mail\CardNotification;
use App\Enum\TransactionStatus;
use App\Enum\TransactionDirection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\CardControllerStoreRequest;
use App\Http\Requests\CardControllerSetCardLimitRequest;

class CardController extends Controller
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
            ['label' => 'Cards', 'url' => null, 'active' => true]
        ];

        $cards = $user->cards()->latest()->get();


        $data = [
            'title' => 'Cards',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'cards' => $cards,
        ];

        return view('dashboard.user.card.index', $data);
    }

    public function create()
    {
        $user = User::find(auth('user')->user()->id);

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Cards', 'url' => route('user.card.index')],
            ['label' => 'Apply for Card', 'url' => null, 'active' => true]
        ];

        $setting = Setting::first();

        $data = [
            'title' => 'Apply for Card',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'cardTypes' => CardType::cases(),
            'setting' => $setting

        ];

        return view('dashboard.user.card.create', $data);
    }

    public function store(CardControllerStoreRequest $request)
    {
        $validated = $request->validated();

        $setting = Setting::first();

        $issuanceFee = $validated['type'] === CardType::Virtual->value ? $setting->virtual_card_fee : $setting->physical_card_fee;

        $user = User::find(auth('user')->user()->id);
        if ($user->balance < $issuanceFee) {
            return back()->with('error', 'Insufficient balance for issuance fee.');
        }

        try {
            DB::beginTransaction();
            $card = Card::create([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'card_number' => $this->generateCardNumber(),
                'expiry_date' => now()->addYears(3)->format('m/y'),
                'cvv' => $this->generateCvv(),
                'type' => $validated['type'],
                'status' => CardStatus::Pending->value,
                'reference_id' => generateReferenceId(),
                'issuance_fee' => $issuanceFee,
            ]);

            // Deduct issuance fee
            $user->balance -= $issuanceFee;
            $user->save();

            // Create transaction
            Transaction::create([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'type' => TransactionType::Payment->value,
                'direction' => TransactionDirection::Debit->value,
                'description' => "Card issuance fee for Ref: {$card->reference_id}",
                'amount' => $issuanceFee,
                'current_balance' => $user->balance,
                'transaction_at' => now(),
                'reference_id' => $card->reference_id,
                'status' => TransactionStatus::Completed->value,
            ]);

            // Create notification
            Notification::create([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'type' => NotificationType::CardRequested->value,
                'message' => "Card request ({$card->type->label()}, Ref: {$card->reference_id}) submitted.",
            ]);

            Mail::to($user->email)->send(new CardNotification($user, $card, 'requested'));

            DB::commit();
            return redirect()->route('user.card.index')->with('success', 'Card request submitted.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Card request failed: ' . $e->getMessage());
            return back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function show(string $uuid)
    {
        $user = User::find(auth('user')->user()->id);

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Cards', 'url' => route('user.card.index')],
            ['label' => 'Card Details', 'url' => null, 'active' => true]
        ];

        $card = $user->cards()->where('uuid', $uuid)->firstOrFail();

        $data = [
            'title' => 'Card Details',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'card' => $card
        ];

        return view('dashboard.user.card.show', $data);
    }

    public function activate(string $uuid)
    {
        $user = User::find(auth('user')->user()->id);

        $card = $user->cards()->where('uuid', $uuid)->firstOrFail();
        if ($card->status->value !== CardStatus::Inactive->value) {
            return back()->with('error', 'Card is not inactive.');
        }

        try {
            DB::beginTransaction();
            $card->status = CardStatus::Active->value;
            $card->save();

            Notification::create([
                'uuid' => str()->uuid(),
                'user_id' => $card->user_id,
                'type' => NotificationType::CardActivated->value,
                'message' => "Card ({$card->type->label()}, Ref: {$card->reference_id}) activated.",
            ]);

            Mail::to($card->user->email)->send(new CardNotification($card->user, $card, 'activated'));

            DB::commit();
            return redirect()->route('user.card.show', $card->uuid)->with('success', 'Card activated.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Card activation failed: ' . $e->getMessage());
            return back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function deactivate(string $uuid)
    {
        $user = User::find(auth('user')->user()->id);

        $card = $user->cards()->where('uuid', $uuid)->firstOrFail();
        if ($card->status->value !== CardStatus::Active->value) {
            return back()->with('error', 'Card is not active.');
        }

        try {
            DB::beginTransaction();
            $card->status = CardStatus::Inactive->value;
            $card->save();

            Notification::create([
                'uuid' => str()->uuid(),
                'user_id' => $card->user_id,
                'type' => NotificationType::CardDeactivated->value,
                'message' => "Card ({$card->type->label()}, Ref: {$card->reference_id}) deactivated.",
            ]);

            Mail::to($card->user->email)->send(new CardNotification($card->user, $card, 'deactivated'));

            DB::commit();
            return redirect()->route('user.card.show', $card->uuid)->with('success', 'Card deactivated.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Card deactivation failed: ' . $e->getMessage());
            return back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function setLimit(CardControllerSetCardLimitRequest $request, $uuid)
    {
        $request->validated();

        $user = User::find(auth('user')->user()->id);

        $card = $user->cards()->where('uuid', $uuid)->firstOrFail();
        if ($card->status->value !== CardStatus::Active->value) {
            return back()->with('error', 'Card is not active.');
        }

        try {
            DB::beginTransaction();
            $card->daily_limit = $request->daily_limit;
            $card->save();

            Notification::create([
                'uuid' => str()->uuid(),
                'user_id' => $card->user_id,
                'type' => NotificationType::AccountUpdate->value,
                'message' => "Card ({$card->type->label()}, Ref: {$card->reference_id}) daily limit set to " . currency($card->user->currency) . formatAmount($card->daily_limit) . ".",
            ]);

            DB::commit();
            return redirect()->route('user.card.show', $card->uuid)->with('success', 'Daily limit updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Card limit update failed: ' . $e->getMessage());
            return back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    private function generateCardNumber()
    {
        $number = '4' . str_pad(mt_rand(0, 999999999999999), 15, '0', STR_PAD_LEFT); // Example: Visa-like
        while (Card::where('card_number', Crypt::encryptString($number))->exists()) {
            $number = '4' . str_pad(mt_rand(0, 999999999999999), 15, '0', STR_PAD_LEFT);
        }
        return $number;
    }

    private function generateCvv()
    {
        $cvv = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
        while (Card::where('cvv', Crypt::encryptString($cvv))->exists()) {
            $cvv = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
        }
        return $cvv;
    }
}
