<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Модель Post — работает с таблицей posts
class Post extends Model
{
    // Разрешаем массовое заполнение
    protected $fillable = [
        'title',
        'slug',
        'author',
        'topic',
        'content',
        'published_at',
        'image_path',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}