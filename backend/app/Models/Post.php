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
        'content'
    ];
}