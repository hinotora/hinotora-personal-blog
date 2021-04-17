<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        $request->preview->move(public_path('articles'), $imageName);
        $imageUrl = '/articles/'.$imageName;

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

    public function delete($id) {
        $article = Article::findOrFail($id);

        $previewUrl = public_path();
        $previewUrl.=$article->preview;

        File::delete($previewUrl);

        if($article->delete()) {
            return redirect()->back()->with('success','Article deleted!');
        }
        else {
            return redirect()->back()->with('fail','Error while deleting');
        }
    }

    public function showUpdateForm($id) {
        $article = Article::findOrFail($id);
        $categories = Category::all();

        return view('admin.article.update', compact('article', 'categories'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'category' => 'required|exists:categories,ID',
            'title' => 'required|max:150',
            'description' => 'required|max:250',
            'body' => 'required',
        ]);

        $article = Article::findOrFail($id);

        $article->title = $request->title;
        $article->category_ID = (int) $request->category;
        $article->published = (bool) $request->mode;
        $article->description = $request->description;
        $article->content = $request->body;

        if(isset($request->preview)) {
            $imageName = explode('/', $article->preview)[2];
            $request->preview->move(public_path('articles'), $imageName);
        }

        $article->save();

        return redirect()->route('page-admin-article-list')->with('success', 'Article updated!');
    }
}
