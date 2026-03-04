<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Spatie\Activitylog\Models\Activity;

class ActivityLogsController extends Controller
{
    public function index()
    {
        $logs = Activity::with(['causer', 'subject'])
            ->latest()
            ->paginate(15);
            
        return Inertia::render('ActivityLogs', [
            'logs' => $logs
        ]);
    }
}