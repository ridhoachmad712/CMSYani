<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $categories = ArticleCategory::query()->orderBy('name')->get();

        $articles = Article::query()
            ->published()
            ->with('category')
            ->when($request->filled('kategori'), function ($query) use ($request) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $request->string('kategori')));
            })
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = '%' . $request->string('q') . '%';
                $query->where(fn ($q) => $q->where('title', 'like', $term)->orWhere('excerpt', 'like', $term));
            })
            ->orderByDesc(DB::raw('COALESCE(published_at, created_at)'))
            ->paginate(9)
            ->withQueryString();

        return view('public.articles.index', [
            'articles' => $articles,
            'categories' => $categories,
            'activeCategory' => $request->string('kategori')->toString(),
            'search' => $request->string('q')->toString(),
        ]);
    }

    public function show(string $slug)
    {
        $article = Article::query()->published()->where('slug', $slug)->firstOrFail();

        // Hitung tampilan (tanpa mempengaruhi updated_at).
        $article->incrementQuietly('views_count');

        $related = Article::query()
            ->published()
            ->where('id', '!=', $article->id)
            ->when($article->article_category_id, fn ($q) => $q->where('article_category_id', $article->article_category_id))
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('public.articles.show', [
            'article' => $article,
            'related' => $related,
        ]);
    }
}
