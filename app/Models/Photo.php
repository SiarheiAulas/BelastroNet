<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\LogsActivity;
use App\Models\Traits\HasAuthor;

class Photo extends Model
{
    use HasFactory, LogsActivity, SoftDeletes, HasAuthor;

}
