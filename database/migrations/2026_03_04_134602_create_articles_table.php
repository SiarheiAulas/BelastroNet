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
            $table->string('author_id')->required();
            $table->set('type', ['Мастерская','Маленькие_хитрости','Наблюдения','Рекомендации_по_наблюдениям','Обработка_фото_и_видео','Международные_астроновости','Разное']);
            $table->string('title')->required();
            $table->string('slug')->required();
            $table->text('text')->required();
            $table->timestamp('deleted_at')->nullable();
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
