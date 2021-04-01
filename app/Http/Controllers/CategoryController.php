<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function list() {
        $categories = Category::all();

        return view('category.list', compact('categories'));
    }

    public function detail($category_slug)
    {
        $category = Category::where('slug', $category_slug)->firstOrFail();

        $articles = $category->articles()->with(['user','category'])->paginate(config('blog.pagination'));

        return view('category.detail', compact('articles'))->with('category_meta', $category);
    }
}
