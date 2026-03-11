<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\LogsActivity;
use App\Models\Traits\HasAuthor;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingFullText;

class Photo extends Model
{
    use HasFactory, LogsActivity, SoftDeletes, HasAuthor, Searchable;

    protected $fillable = ['type', 'author_id','title','storage_link','description'];

    #[SearchUsingFullText(['title', 'description'])]
    public function toSearchableArray(){
        
        $array = [
            'title' => $this->title,
            'description' => $this->description
        ];
        
        return $array;
    }
}
