<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\LogsActivity;

class Document extends Model
{
    use HasFactory, LogsActivity;
}
