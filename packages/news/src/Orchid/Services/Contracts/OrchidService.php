<?php

namespace Akrbdk\News\Orchid\Services\Contracts;

use Akrbdk\News\Models\Category;
use Akrbdk\News\Models\Element;
use Akrbdk\News\Repositories\Contracts\CategoryRepository;
use Akrbdk\News\Repositories\Contracts\ElementRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface OrchidService
{
    public function __construct(
        CategoryRepository $categoryRepository,
        ElementRepository $elementRepository
    );
    public function saveCategory(Category $category, Request $request): RedirectResponse;

    public function saveElement(Element $element, Request $request): RedirectResponse;
}
