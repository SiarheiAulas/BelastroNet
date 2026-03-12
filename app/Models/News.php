<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\LogsActivity;
use App\Models\Traits\HasAuthor;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingFullText;

class News extends Model
{
    use HasFactory, LogsActivity, SoftDeletes, HasAuthor, Searchable;
    
    protected $fillable = ['author_id','slug','title_ru','text_ru','title_by','text_by','title_en','text_en'];

    #[SearchUsingFullText(['title_ru','text_ru','title_by','text_by','title_en','text_en'])]
    public function toSearchableArray(){
        
        $array = [
            'title_ru' => $this->title_ru,
            'text_ru' => $this->text_ru,
            'title_by' => $this->title_by,
            'text_by' => $this->text_by,
            'title_en' => $this->title_en,
            'text_en' => $this->text_en
        ];
        
        return $array;
    }
}
