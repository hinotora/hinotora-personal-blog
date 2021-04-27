<?php

namespace App\Composers;

use App\Models\Article;
use Illuminate\View\View;

class AsideComposer
{
    /**
     * Renders micro view for placing in main view.
     * Micro view with top 10 articles on the right aside.
     *
     * @param View $view
     * @return View
     */
    public function compose(View $view): View
    {
        $articles = Article::where('published', 1)->orderBy('views', 'desc')->limit(10)->get();

        return $view->with('aside_articles', $articles);
    }
}
