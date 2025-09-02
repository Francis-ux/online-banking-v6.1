<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $breadcrumbs = [
            ['label' => 'Admin Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Home', 'url' => null, 'active' => true] // active state
        ];

        $data = [
            'title' => 'Admin Dashboard',
            'breadcrumbs' => $breadcrumbs
        ];

        return view('dashboard.admin.home', $data);
    }
}
