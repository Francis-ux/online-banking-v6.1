<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Enum\CardStatus;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Enum\NotificationType;
use App\Mail\CardNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class UserCardController extends Controller
{
    public function index(string $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Cards', 'url' => null, 'active' => true],
        ];

        $cards = $user->cards()->latest()->get();

        $data = [
            'title' => 'Cards',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'cards' => $cards,
        ];

        return view('dashboard.admin.user.card.index', $data);
    }
    public function show(string $uuid, string $cardUUID)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Cards', 'url' => route('admin.user.card.index', $user->uuid)],
            ['label' => 'Card Details', 'url' => null, 'active' => true],
        ];

        $card = $user->cards()->where('uuid', $cardUUID)->first();

        $data = [
            'title' => 'Card Details',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'card' => $card,
        ];

        return view('dashboard.admin.user.card.show', $data);
    }

    public function issue(string $uuid, string $cardUUID)
    {
        $user = User::where('uuid', $uuid)->first();

        $card = $user->cards()->where('uuid', $cardUUID)->first();
        if ($card->status->value !== CardStatus::Pending->value) {
            return back()->with('error', 'Card is not pending.');
        }

        try {
            DB::beginTransaction();
            $card->status = CardStatus::Active->value;
            $card->issued_at = now();
            $card->save();

            Notification::create([
                'uuid' => str()->uuid(),
                'user_id' => $card->user_id,
                'type' => NotificationType::CardIssued->value,
                'message' => "Card ({$card->type->label()}, Ref: {$card->reference_id}) issued.",
            ]);

            Mail::to($card->user->email)->send(new CardNotification($card->user, $card, 'issued'));

            DB::commit();
            return redirect()->route('admin.user.card.show', [$user->uuid, $card->uuid])->with('success', 'Card issued.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Card issuance failed: ' . $e->getMessage());
            return back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function block(string $uuid, string $cardUUID)
    {
        $user = User::where('uuid', $uuid)->first();

        $card = $user->cards()->where('uuid', $cardUUID)->first();
        if ($card->status->value === CardStatus::Blocked->value) {
            return back()->with('error', 'Card is already blocked.');
        }

        try {
            DB::beginTransaction();
            $card->status = CardStatus::Blocked->value;
            $card->save();

            Notification::create([
                'uuid' => str()->uuid(),
                'user_id' => $card->user_id,
                'type' => NotificationType::CardBlocked->value,
                'message' => "Card ({$card->type->label()}, Ref: {$card->reference_id}) blocked.",
            ]);

            Mail::to($card->user->email)->send(new CardNotification($card->user, $card, 'blocked'));

            DB::commit();
            return redirect()->route('admin.user.card.show', [$user->uuid, $card->uuid])->with('success', 'Card blocked.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Card block failed: ' . $e->getMessage());
            return back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
