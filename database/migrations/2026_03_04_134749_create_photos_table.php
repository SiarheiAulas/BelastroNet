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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->set('type', ['landscapes','sun_and_moon','solar_system','deepsky','sat','misc']);
            $table->foreignId('author_id')->required();
            $table->string('storage_link')->required();
            $table->string('title_ru')->required();
            $table->text('description_ru')->required();
            $table->string('title_by')->required();
            $table->text('description_by')->required();
            $table->string('title_en')->required();
            $table->text('description_en')->required();
            $table->fullText(['title_ru','description_ru','title_by','description_by','title_en','description_en'], 'photos_fulltext');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
