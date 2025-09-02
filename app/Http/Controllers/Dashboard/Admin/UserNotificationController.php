<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Enum\NotificationType;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserNotificationControllerSendStoreRequest;
use App\Mail\UserNotificationSuccess;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserNotificationController extends Controller
{
    public function index(string $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Notifications', 'url' => null, 'active' => true],
        ];

        $notifications = $user->notifications()->latest()->get();

        $data = [
            'title' => 'Notifications',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'notifications' => $notifications,
        ];

        return view('dashboard.admin.user.notification.index', $data);
    }

    public function show(string $uuid, string $notificationUUID)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Notifications', 'url' => route('admin.user.notification.index', $user->uuid)],
            ['label' => 'Notification Details', 'url' => null, 'active' => true],
        ];

        $notification = $user->notifications()->where('uuid', $notificationUUID)->first();

        $data = [
            'title' => 'Notification Details',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'notification' => $notification,
        ];

        return view('dashboard.admin.user.notification.show', $data);
    }

    public function delete(string $uuid, string $notificationUUID)
    {
        try {
            DB::beginTransaction();

            $user = User::where('uuid', $uuid)->first();

            $notification = $user->notifications()->where('uuid', $notificationUUID)->first();

            $notification->delete();

            DB::commit();

            return redirect()->route('admin.user.notification.index', [$user->uuid])->with('success', 'Notification deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('admin.user.notification.index', [$user->uuid])->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function send(string $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'User', 'url' => route('admin.user.show', $user->uuid)],
            ['label' => 'Notifications', 'url' => route('admin.user.notification.index', $user->uuid)],
            ['label' => 'Send Notification', 'url' => null, 'active' => true],
        ];

        $data = [
            'title' => 'Send Notification',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'notificationTypes' => NotificationType::cases(),
        ];

        return view('dashboard.admin.user.notification.send', $data);
    }

    public function sendStore(UserNotificationControllerSendStoreRequest $request, string $uuid)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $user = User::where('uuid', $uuid)->first();

            $notification = Notification::create([
                'uuid' => str()->uuid(),
                'user_id' => $user->id,
                'type' => $validated['type'],
                'message' => $validated['message'],
            ]);

            Mail::to($user->email)->send(new UserNotificationSuccess($user, $notification, $validated['title']));

            DB::commit();

            return redirect()->route('admin.user.notification.index', [$user->uuid])->with('success', 'Notification sent successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('admin.user.notification.index', [$user->uuid])->with('error', env('APP_ERROR_MESSAGE'));
        }
    }
}
