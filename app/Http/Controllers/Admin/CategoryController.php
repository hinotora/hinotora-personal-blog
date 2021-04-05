<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list() {
        $categories = Category::all();

        return view('admin.category.list', compact('categories'));
    }

    public function showNewForm() {

    }

    public function new(Request $request) {

    }

    public function delete($id) {

    }

    public function showUpdateForm() {

    }

    public function update(Request $request, $id) {

    }

}
