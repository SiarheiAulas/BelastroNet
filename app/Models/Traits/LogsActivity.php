<?php

namespace App\Models\Traits;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity as OriginalLogsActivity;

trait LogsActivity
{
    use OriginalLogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()                          
            ->logOnlyDirty()     
            ->dontSubmitEmptyLogs();
    }
}