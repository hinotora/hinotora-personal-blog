<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function recent()
    {
        $articles = Article::with(['user','category'])
            ->where('published', 1)
            ->orderBy('created_at', 'desc')->limit(3)->get();

        return view('home', compact('articles'));
    }

    public function list()
    {
        $articles = Article::with(['user','category'])
            ->where('published', 1)
            ->paginate(config('blog.pagination'));

        return view('article.list', compact('articles'));
    }

    public function detail(string $slug)
    {
        $article = Article::with(['user','category'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Adjust view if published
        if ($article->published) {
            $article->views+=1;
            $article->save();
        }

        return view('article.detail', compact('article'));
    }
}
