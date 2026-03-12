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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('author_id')->required();
            $table->string('url')->required();
            $table->string('author_ru')->required();
            $table->string('title_ru')->required();
            $table->text('description_ru')->required();
            $table->string('author_by')->required();
            $table->string('title_by')->required();
            $table->text('description_by')->required();
            $table->string('author_en')->required();
            $table->string('title_en')->required();
            $table->text('description_en')->required();
            $table->fullText(['author_ru','title_ru','description_ru','author_by','title_by','description_by','author_en','title_en','description_en'], 'sites_fulltext');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
