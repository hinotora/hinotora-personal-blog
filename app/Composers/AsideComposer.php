<?php
namespace App\Composers;

use App\Models\Article;
use Illuminate\View\View;

class AsideComposer
{
    public function compose(View $view)
    {
        $articles = Article::where('published', 1)->orderBy('views', 'desc')->limit(10)->get();

        return $view->with('aside_articles', $articles);
    }
}
