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
            'preview'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $name = $request->name;
        $slug = Str::slug($name, '-');

        $image_id = uniqid();
        $imageName = $image_id.'.'.$request->preview->extension();
        $request->preview->move(public_path('categories'), $imageName);
        $imageUrl = '/categories/'.$imageName;

        $category = new Category();
        $category->name = $name;
        $category->description = $request->description;
        $category->slug = $slug;
        $category->preview = $imageUrl;

        $category->save();

        return redirect()->route('page-admin-category-list')->with('success', 'Category created!')->setStatusCode(201);
    }

    public function delete($id) {
        $category = Category::findOrFail($id);

        $previewUrl = public_path();
        $previewUrl.=$category->preview;

        File::delete($previewUrl);

        if($category->delete()) {
            return redirect()->back()->with('success','Category deleted!');
        }
        else {
            return redirect()->back()->with('fail','Error while deleting')->setStatusCode(204);
        }
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
            $imageName = explode('/', $category->preview)[2];
            $request->preview->move(public_path('categories'), $imageName);
        }

        $category->save();

        return redirect()->route('page-admin-category-list')->with('success', 'Category updated!');
    }

}
