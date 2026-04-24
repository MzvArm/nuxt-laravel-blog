<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Миграция создаёт таблицу posts
return new class extends Migration {
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // primary key

            $table->string('title'); // заголовок поста
            $table->string('slug')->unique(); // уникальный slug для URL

            $table->text('content'); // основной текст поста

            $table->timestamps(); // created_at и updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};