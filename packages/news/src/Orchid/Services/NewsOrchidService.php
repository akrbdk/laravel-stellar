<?php

namespace Akrbdk\News\Orchid\Services;

use Akrbdk\News\Models\Category;
use Akrbdk\News\Models\Element;
use Akrbdk\News\Orchid\Services\Contracts\OrchidService;
use Akrbdk\News\Repositories\Contracts\CategoryRepository;
use Akrbdk\News\Repositories\Contracts\ElementRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Orchid\Support\Facades\Toast;

class NewsOrchidService implements Contracts\OrchidService
{
    public function __construct(
        CategoryRepository $categoryRepository,
        ElementRepository $elementRepository)
    {
    }

    public function saveCategory(Category $category, Request $request): RedirectResponse
    {
        $categoryData = $request->only([
            'category.title',
            'category.slug',
            'category.active',
            'category.priority'
        ]);

        $categoryData = Arr::get($categoryData, 'category');
        $category->fill($categoryData);
        $category->alias = Str::slug($category->title);
        $category->user()->associate(auth()->user());
        unset($categoryData);
        resolve(CategoryRepository::class)->save($category);

        Toast::info(trans('akrbdk-news::admin.orchid.success'));

        return redirect()->route('platform.news.categories');
    }

    public function saveElement(Element $element, Request $request): RedirectResponse
    {
        $elementData = $request->only([
            'element.title',
            'element.slug',
            'element.active',
            'element.priority'
        ]);

        $elementData = Arr::get($elementData, 'element');
        $element->fill($elementData);
        $element->alias = Str::slug($element->title);
        $element->user()->associate(auth()->user());
        unset($elementData);
        resolve(ElementRepository::class)->save($element);

        Toast::info(trans('akrbdk-news::admin.orchid.success'));

        return redirect()->route('platform.news.elements');
    }
}
