<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

trait HasAuthor
{
	public function author(){
        
        return $this->belongsTo(User::class, 'author_id');

    }
}