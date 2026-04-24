<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;

// Контроллер обрабатывает API-запросы
class PostController extends Controller
{
    // GET /api/posts
    public function index()
    {
        // Берём последние посты + пагинация
        $posts = Post::latest()->paginate(10);

        // Возвращаем через Resource (чистый JSON)
        return PostResource::collection($posts);
    }

    // GET /api/posts/{slug}
    public function show($slug)
    {
        // Ищем пост по slug или 404
        $post = Post::where('slug', $slug)->firstOrFail();

        return new PostResource($post);
    }
}