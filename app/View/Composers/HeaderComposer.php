<?php

namespace App\View\Composers;

use App\Repositories\CategoryRepository;
use Illuminate\View\View;

class HeaderComposer
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
    ) {
    }

    public function compose(View $view): void
    {
        $view->with('navigationCategories', $this->categoryRepository->getNavigationCategories());
    }
}
