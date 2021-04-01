<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function list(Request $request) {

        $search_text = $request->input('q');

        $articles = Article::with(['user','category'])
            ->where('title', 'like' , "%$search_text%")
            ->orderBy('created_at', 'desc')
            ->paginate(config('blog.pagination'));

        return view('admin.article.list', compact('articles'));
    }
}
