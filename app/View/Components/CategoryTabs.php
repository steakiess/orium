<?php

namespace App\View\Components;

use Closure;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CategoryTabs extends Component
{
    public function __construct() {

    }

    public function render(): View|Closure|string
    {
        $categories = Category::get();
        return view('components.category-tabs', ['categories' => $categories]);
    }
}
