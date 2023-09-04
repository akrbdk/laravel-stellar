<?php

namespace Akrbdk\News\Orchid\Services;

use Akrbdk\News\Models\Category;
use Akrbdk\News\Models\Element;
use Akrbdk\News\Orchid\Services\Contracts\OrchidService;
use Akrbdk\News\Repositories\Contracts\CategoryRepository;
use Akrbdk\News\Repositories\Contracts\ElementRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsOrchidService implements Contracts\OrchidService
{

    public function __construct(CategoryRepository $categoryRepository, ElementRepository $elementRepository)
    {
    }

    public function saveCategory(Category $category, Request $request): RedirectResponse
    {
        // TODO: Implement saveCategory() method.
    }

    public function saveElement(Element $element, Request $request): RedirectResponse
    {
        // TODO: Implement saveElement() method.
    }
}
