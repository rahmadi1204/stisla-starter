<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        return view('dashboard.dashboard', compact(
            [
                'title',
            ]
        ));
    }
}
