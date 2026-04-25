<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    // POST /api/posts
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_at' => 'nullable|date',
            'topic' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $counter = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create([
            'title' => $data['title'],
            'author' => $data['author'],
            'topic' => $data['topic'],
            'content' => $data['content'],
            'published_at' => $data['published_at'] ?? now(),
            'slug' => $slug,
            'image_path' => $imagePath,
        ]);

        return new PostResource($post);
    }
}