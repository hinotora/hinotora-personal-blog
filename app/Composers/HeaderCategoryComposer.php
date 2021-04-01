<?php
namespace App\Composers;

use App\Models\Category;
use Illuminate\View\View;

class HeaderCategoryComposer
{
    public function compose(View $view)
    {
        $categories = Category::all();

        return $view->with('header_categories', $categories);
    }
}
