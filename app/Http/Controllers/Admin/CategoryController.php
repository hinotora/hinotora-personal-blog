<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Returns view with list of categories in admin section.
     *
     * @return View
     */
    public function list(): View
    {
        $categories = Category::all();

        return view('admin.category.list', compact('categories'));
    }

    /**
     * Returns view of new adding category form.
     *
     * @return View
     */
    public function new(): View
    {
        return view('admin.category.new');
    }

    /**
     * Creates new category from request data and redirects
     * back with result in session.
     *
     * @param CategoryStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Saving banner image into local storage
        if (isset($validated['preview'])) {
            $storagePrefix = '/storage/';
            $imageUrl = Storage::disk('public')->putFileAs(
                config('blog.preview_folders.category'), $validated['preview'], uniqid().'.jpg'
            );
            $imageUrl = $storagePrefix.$imageUrl;
        } else {
            $imageUrl = config('blog.preview');
        }

        $category = new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'];
        $category->slug = Str::of($validated['name'])->slug();
        $category->preview = $imageUrl;

        $category->save();

        return redirect()->route('page-admin-category-list')->with('success', 'Category created!');
    }

    /**
     * Removes category by id and redirects back
     * with result in session.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $previewUrl = public_path();
        $previewUrl.=$category->preview;

        File::delete($previewUrl);

        $category->delete();

        return redirect()->route('page-admin-category-list')->with('success','Category deleted!');
    }

    /**
     * Returns update view of existing category.
     *
     * @param int $id
     * @return View
     */
    public function update(int $id): View
    {
        $category = Category::findOrFail($id);

        return view('admin.category.update', compact('category'));
    }

    /**
     * Updates existing view with request data and
     * redirects back with result in session.
     *
     * @param CategoryStoreRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function store_update(CategoryStoreRequest $request, int $id): RedirectResponse
    {
        $validated = $request->validated();

        $category = Category::findOrFail($id);

        $category->name = $validated['name'];
        $category->description = $validated['description'];

        if(isset($validated['preview'])) {
            $previewUrl = public_path();
            $previewUrl.=$category->preview;

            File::delete($previewUrl);

            $imageUrl = Storage::disk('public')->putFileAs(
                config('blog.preview_folders.category'), $validated['preview'], uniqid().'.jpg'
            );

            $category->preview = '/storage/'.$imageUrl;
        }

        $category->save();

        return redirect()->route('page-admin-category-list')->with('success', 'Category updated!');
    }
}
