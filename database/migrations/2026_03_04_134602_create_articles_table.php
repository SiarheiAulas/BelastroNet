<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->set('type', ['workshop','tricks','observations','recommendations','photo_and_video','astronews','misc']);
            $table->foreignId('author_id')->required();
            $table->string('slug')->required();
            $table->string('title_ru')->required();
            $table->text('text_ru')->required();
            $table->string('title_by')->required();
            $table->text('text_by')->required();
            $table->string('title_en')->required();
            $table->text('text_en')->required();
            $table->fullText(['title_ru','text_ru','title_by','text_by','title_en','text_en'], 'articles_fulltext');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
