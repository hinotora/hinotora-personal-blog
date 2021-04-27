<?php

namespace App\Composers;

use App\Models\Category;
use Illuminate\View\View;

class HeaderCategoryComposer
{
    /**
     * Renders micro view for placing in main view.
     * Micro view with top categories in the header.
     *
     * @param View $view
     * @return View
     */
    public function compose(View $view)
    {
        $categories = Category::all();

        return $view->with('header_categories', $categories);
    }
}
