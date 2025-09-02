<?php

namespace App\Http\Controllers\Dashboard\Master;

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
            ['label' => 'Master Admin Dashboard', 'url' => route('master.dashboard')],
            ['label' => 'Home', 'url' => null, 'active' => true] // active state
        ];

        $data = [
            'title' => 'Master Admin Dashboard',
            'breadcrumbs' => $breadcrumbs
        ];

        return view('dashboard.master.home', $data);
    }
}
