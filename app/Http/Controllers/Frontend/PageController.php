<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactNotification;
use App\Http\Requests\PageControllerContactStore;

class PageController extends Controller
{
    public function about()
    {
        $data = ['title' => 'About'];

        return view('frontend.pages.about', $data);
    }

    public function contact()
    {
        $data = ['title' => 'Contact'];

        return view('frontend.pages.contact', $data);
    }

    public function contactStore(PageControllerContactStore $request)
    {
        $validated = $request->validated();

        try {
            Mail::to(env('APP_EMAIL'))->send(new ContactNotification($validated, 'Contact Notification'));

            return redirect()->route('contact')->with('success', 'Your message has been sent successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', env('APP_ERROR_MESSAGE'));
        }
    }

    public function services()
    {
        $data = ['title' => 'Services'];

        return view('frontend.pages.services', $data);
    }

    public function faqs()
    {
        $data = ['title' => 'Faqs'];

        return view('frontend.pages.faqs', $data);
    }
}
