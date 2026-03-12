<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\LogsActivity;
use App\Models\Traits\HasAuthor;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingFullText;

class Site extends Model
{
    use HasFactory, LogsActivity, SoftDeletes, HasAuthor, Searchable;

    protected $fillable = ['author_id','author','url','author_ru','title_ru','description_ru','author_by','title_by','description_by','author_en','title_en','description_en'];

    #[SearchUsingFullText(['author_ru','title_ru','description_ru','author_by','title_by','description_by','author_en','title_en','description_en'])]
    public function toSearchableArray(){
        
        $array = [
            'author_ru' => $this->author_ru,
            'title_ru' => $this->title_ru,
            'description_ru' => $this->description_ru,
            'author_by' => $this->author_by,
            'title_by' => $this->title_by,
            'description_by' => $this->description_by,
            'author_en' => $this->author_en,
            'title_en' => $this->title_en,
            'description_en' => $this->description_en
        ];
        
        return $array;
    }
}
