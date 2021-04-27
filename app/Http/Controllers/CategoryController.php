<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    /**
     * Returns view with all categories.
     *
     * @return View
     */
    public function list(): View
    {
        $categories = Category::all();

        return view('category.list', compact('categories'));
    }

    /**
     * Shows all articles with category slug.
     *
     * @param $categorySlug
     * @return View
     */
    public function detail(string $categorySlug): View
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        $articles = $category->articles()->with(['user','category'])->paginate(config('blog.pagination'));

        return view('category.detail', compact('articles'))->with('category_meta', $category);
    }
}
