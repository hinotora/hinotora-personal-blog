<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;

class ArticleController extends Controller
{
    /**
     * Returns view with three recent articles on main page.
     *
     * @return View
     */
    public function recent(): View
    {
        $articles = Article::with(['user','category'])
            ->where('published', 1)
            ->latest()
            ->limit(3)
            ->get();

        return view('home', compact('articles'));
    }

    /**
     * Returns view with list of all article with pagination.
     *
     * @return View
     */
    public function list(): View
    {
        $articles = Article::with(['user','category'])
            ->where('published', 1)
            ->paginate(config('blog.pagination'));

        return view('article.list', compact('articles'));
    }

    /**
     * Shows full detail of article.
     *
     * @param string $slug
     * @return View
     */
    public function detail(string $slug): View
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
