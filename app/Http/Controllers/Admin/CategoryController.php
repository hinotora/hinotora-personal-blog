<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function list() {
        $categories = Category::all()->sortByDesc('ID');

        return view('admin.category.list', compact('categories'));
    }

    public function showNewForm() {
        return view('admin.category.new');
    }

    public function new(Request $request) {
        $validated = $request->validate([
            'name'=>'required|max:50',
            'description'=>'required|max:100',
            'preview'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $name = $request->name;
        $slug = Str::slug($name, '-');

        $image_url = Storage::disk('public')->putFileAs(
            config('blog.preview.category'), $request->preview, uniqid().'.jpg'
        );

        $category = new Category();
        $category->name = $name;
        $category->description = $request->description;
        $category->slug = $slug;
        $category->preview = '/storage/'.$image_url;

        $category->save();

        return redirect()->route('page-admin-category-list')->with('success', 'Category created!')->setStatusCode(201);
    }

    public function delete($id) {
        $category = Category::findOrFail($id);

        $previewUrl = public_path();
        $previewUrl.=$category->preview;

        File::delete($previewUrl);

        $category->delete();

        return redirect()->back()->with('success','Category deleted!')->setStatusCode(200);
    }

    public function showUpdateForm($id) {
        $category = Category::findOrFail($id);

        return view('admin.category.update', compact('category'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name'=>'required|max:50',
            'description'=>'required|max:100',
        ]);

        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->description = $request->description;

        if(isset($request->preview)) {
            $previewUrl = public_path();
            $previewUrl.=$category->preview;

            File::delete($previewUrl);

            $image_url = Storage::disk('public')->putFileAs(
                config('blog.preview.category'), $request->preview, uniqid().'.jpg'
            );

            $category->preview = '/storage/'.$image_url;
        }

        $category->save();

        return redirect()->route('page-admin-category-list')->with('success', 'Category updated!')->setStatusCode(200);
    }

}
