<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\LogsActivity;
use App\Models\Traits\HasAuthor;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingFullText;

class Link extends Model
{
 	use HasFactory, LogsActivity, SoftDeletes, HasAuthor, Searchable;

    protected $fillable = ['author_id','url','title_ru','description_ru','title_by','description_by','title_en','description_en'];

	#[SearchUsingFullText(['title_ru','description_ru','title_by','description_by','title_en','description_en'])]
    public function toSearchableArray(){
        
        $array = [
            'title_ru' => $this->title_ru,
            'description_ru' => $this->description_ru,
            'title_by' => $this->title_by,
            'description_by' => $this->description_by,
            'title_en' => $this->title_en,
            'description_en' => $this->description_en
        ];
        
        return $array;
    }
}
