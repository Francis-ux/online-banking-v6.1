<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
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
            ['label' => 'Notifications', 'url' => null, 'active' => true]
        ];

        $notifications = $user->notifications()->latest()->get();

        $data = [
            'title' => 'Notifications',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'notifications' => $notifications
        ];

        return view('dashboard.user.notification.index', $data);
    }

    public function show(string $uuid)
    {
        $user = User::find(auth('user')->user()->id);

        $notification = Notification::where('user_id', $user->id)->where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => $user->first_name . ' ' . $user->last_name, 'url' => route('user.dashboard')],
            ['label' => 'Notifications', 'url' => route('user.notification.index')],
            ['label' => 'Notification Details', 'url' => null, 'active' => true]
        ];

        $notification->is_read = true;
        $notification->save();

        $data = [
            'title' => 'Notification Details',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'notification' => $notification
        ];

        return view('dashboard.user.notification.show', $data);
    }

    public function markAllAsRead()
    {
        try {
            DB::beginTransaction();

            $user = User::find(auth('user')->user()->id);
            $user->notifications()->update(['is_read' => true]);

            DB::commit();

            return redirect()->route('user.notification.index')->with('success', 'Notifications marked as read successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
