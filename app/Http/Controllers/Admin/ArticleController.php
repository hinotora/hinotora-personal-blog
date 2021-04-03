<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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

    public function showNewForm() {
        $categories = Category::all();

        return view('admin.article.new', compact('categories'));
    }

    public function new(Request $request) {

        $validated = $request->validate([
            'category' => 'required|exists:categories,ID',
            'title' => 'required|max:150',
            'description' => 'required|max:250',
            'preview' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required',
        ]);

        // Prepare variables
        $title = $request->title;
        $user_id = Auth::id();
        $image_id = uniqid();
        $slug = Str::of($title)->slug('-');

        // Saving banner image into local storage
        $imageName = $image_id.'.'.$request->preview->extension();
        $request->preview->move(public_path('blog'), $imageName);
        $imageUrl = '/blog/'.$imageName;

        // Starting to save data
        $article = new Article();
        $article->user_ID = $user_id;
        $article->category_ID = (int) $request->category;
        $article->published = (bool) $request->mode;
        $article->title = $title;
        $article->slug = $slug;
        $article->description = $request->description;
        $article->created_at = now();
        $article->content = $request->body;
        $article->preview = $imageUrl;
        $article->save();

        // Redirect to article list with message
        return redirect()->route('page-admin-article-list')->with('success', 'Article created!');
    }
}
