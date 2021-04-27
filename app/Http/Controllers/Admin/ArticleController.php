<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Returns view of article list in admin section.
     *
     * @param Request $request
     * @return View
     */
    public function list(Request $request): View
    {
        $searchText = $request->input('q');

        $articles = Article::with(['user','category'])
            ->where('title', 'like' , "%$searchText%")
            ->latest()
            ->paginate(config('blog.pagination'));

        return view('admin.article.list', compact('articles'));
    }

    /**
     * Returns new adding form for article.
     *
     * @return View
     */
    public function new(): View
    {
        $categories = Category::all();

        return view('admin.article.new', compact('categories'));
    }

    /**
     * Creates new article by received data and media in request and
     * redirects back with result in session.
     *
     * @param ArticleStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ArticleStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (isset($validated['preview'])) {
            $storagePrefix = '/storage/';
            $imageUrl = Storage::disk('public')->putFileAs(
                config('blog.preview_folders.article'),
                $validated['preview'],
                uniqid().'.jpg'
            );
            $imageUrl = $storagePrefix.$imageUrl;
        } else {
            $imageUrl = config('blog.preview');
        }

        $article = new Article();
        $article->user_ID = Auth::id();
        $article->category_ID = (int) $validated['category'];
        $article->published = (bool) $validated['mode'];
        $article->title = $validated['title'];
        $article->slug = Str::of($validated['title'])->slug();
        $article->description = $validated['description'];
        $article->created_at = now();
        $article->content = $validated['body'];
        $article->preview = $imageUrl;
        $article->save();

        return redirect()->route('page-admin-article-list')->with('success', 'Article created!');
    }

    /**
     * Deletes article and it's media by id
     * and redirects back with result in session.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);

        $previewUrl = public_path();
        $previewUrl.=$article->preview;

        File::delete($previewUrl);

        $article->delete();

        return redirect()->route('page-admin-article-list')->with('success','Article deleted!');
    }

    /**
     * Returns view of updating existing article.
     *
     * @param int $id
     * @return View
     */
    public function update(int $id): View
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();

        return view('admin.article.update', compact('article', 'categories'));
    }

    /**
     * Updates existing article by data in request and
     * redirects back with result in session.
     *
     * @param ArticleStoreRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function store_update(ArticleStoreRequest $request, int $id): RedirectResponse
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

            $imageUrl = Storage::disk('public')->putFileAs(
                config('blog.preview_folders.article'), $validated['preview'], uniqid().'.jpg'
            );

            $article->preview = '/storage/'.$imageUrl;
        }

        $article->save();

        return redirect()->route('page-admin-article-list')->with('success', 'Article updated!');
    }
}
