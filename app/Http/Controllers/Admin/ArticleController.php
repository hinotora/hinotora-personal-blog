<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function list(Request $request)
    {
        $search_text = $request->input('q');

        $articles = Article::with(['user','category'])
            ->where('title', 'like' , "%$search_text%")
            ->orderBy('created_at', 'desc')
            ->paginate(config('blog.pagination'));

        return view('admin.article.list', compact('articles'));
    }

    public function new()
    {
        $categories = Category::all();

        return view('admin.article.new', compact('categories'));
    }

    public function store(ArticleStoreRequest $request)
    {
        $validated = $request->validated();

        // Saving banner image into local storage
        if (isset($validated['preview'])) {
            $storage_prefix = '/storage/';
            $image_url = Storage::disk('public')->putFileAs(
                config('blog.preview_folders.article'), $validated['preview'], uniqid().'.jpg'
            );
            $image_url = $storage_prefix.$image_url;
        } else {
            $image_url = config('blog.preview');
        }

        // Starting to save data
        $article = new Article();
        $article->user_ID = Auth::id();
        $article->category_ID = (int) $validated['category'];
        $article->published = (bool) $validated['mode'];
        $article->title = $validated['title'];
        $article->slug = Str::of($validated['title'])->slug('-');;
        $article->description = $validated['description'];
        $article->created_at = now();
        $article->content = $validated['body'];
        $article->preview = $image_url;
        $article->save();

        // Redirect to article list with message
        return redirect()->route('page-admin-article-list')->with('success', 'Article created!');
    }

    public function delete($id)
    {
        $article = Article::findOrFail($id);

        $previewUrl = public_path();
        $previewUrl.=$article->preview;

        File::delete($previewUrl);

        $article->delete();

        return redirect()->route('page-admin-article-list')->with('success','Article deleted!');
    }

    public function update($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();

        return view('admin.article.update', compact('article', 'categories'));
    }

    public function store_update(ArticleStoreRequest $request, $id)
    {
        $validated = $request->validated();

        $article = Article::findOrFail($id);

        $article->title = $validated['title'];
        $article->category_ID = (int) $validated['category'];
        $article->published = (bool) $validated['mode'];
        $article->description = $validated['description'];
        $article->content = $validated['body'];

        if(isset($validated['preview'])) {
            $previewUrl = public_path();
            $previewUrl.=$article->preview;

            File::delete($previewUrl);

            $image_url = Storage::disk('public')->putFileAs(
                config('blog.preview_folders.article'), $validated['preview'], uniqid().'.jpg'
            );

            $article->preview = '/storage/'.$image_url;
        }

        $article->save();

        return redirect()->route('page-admin-article-list')->with('success', 'Article updated!');
    }
}
