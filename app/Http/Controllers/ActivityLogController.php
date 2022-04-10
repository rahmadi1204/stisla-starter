<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function store($request)
    {
        ActivityLog::create([
            'user_id' => auth()->user()->uid,
            'name' => auth()->user()->name,
            'log_type' => $request['log_type'],
            'log_category' => $request['log_category'],
            'log_desc' => $request['log_desc'],
            'status' => $request['status'],
        ]);
    }
}
