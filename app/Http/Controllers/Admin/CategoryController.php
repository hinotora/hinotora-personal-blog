<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = Category::all()->sortByDesc('ID');

        return view('admin.category.list', compact('categories'));
    }

    public function new()
    {
        return view('admin.category.new');
    }

    public function store(CategoryStoreRequest $request)
    {
        $validated = $request->validated();

        // Saving banner image into local storage
        if (isset($validated['preview'])) {
            $storage_prefix = '/storage/';
            $image_url = Storage::disk('public')->putFileAs(
                config('blog.preview.category'), $validated['preview'], uniqid().'.jpg'
            );
            $image_url = $storage_prefix.$image_url;
        } else {
            $image_url = config('blog.default_preview');
        }

        $category = new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'];
        $category->slug = Str::slug($validated['name'], '-');;
        $category->preview = $image_url;

        $category->save();

        return redirect()->route('page-admin-category-list')->with('success', 'Category created!');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        $previewUrl = public_path();
        $previewUrl.=$category->preview;

        File::delete($previewUrl);

        $category->delete();

        return redirect()->route('page-admin-category-list')->with('success','Category deleted!');
    }

    public function update($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.update', compact('category'));
    }

    public function store_update(CategoryStoreRequest $request, $id)
    {
        $validated = $request->validated();

        $category = Category::findOrFail($id);

        $category->name = $validated['name'];
        $category->description = $validated['description'];

        if(isset($validated['preview'])) {
            $previewUrl = public_path();
            $previewUrl.=$category->preview;

            File::delete($previewUrl);

            $image_url = Storage::disk('public')->putFileAs(
                config('blog.preview.category'), $validated['preview'], uniqid().'.jpg'
            );

            $category->preview = '/storage/'.$image_url;
        }

        $category->save();

        return redirect()->route('page-admin-category-list')->with('success', 'Category updated!');
    }
}
