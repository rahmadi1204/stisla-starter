<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function index()
    {
        $title = "Data Logs";
        return view('laravel-log-viewer::logs', compact(['title']));
    }
}
