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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('author_id')->required();
            $table->string('url')->required();
            $table->string('title_ru')->required();
            $table->text('description_ru')->required();
            $table->string('title_by')->required();
            $table->text('description_by')->required();
            $table->string('title_en')->required();
            $table->text('description_en')->required();
            $table->fullText(['title_ru','description_ru','title_by','description_by','title_en','description_en'],'links_fulltext');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
