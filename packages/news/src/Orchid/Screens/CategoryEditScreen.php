<?php

namespace Akrbdk\News\Orchid\Screens;

use Akrbdk\News\Models\Category;
use Akrbdk\News\Orchid\Layouts\Category\EditLayout;
use Akrbdk\News\Orchid\Services\NewsOrchidService;
use Akrbdk\News\Repositories\Contracts\CategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CategoryEditScreen extends Screen
{
    private bool $categoryExists = false;

    public ?Category $category = null;

    private ?string $title = null;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Category $category): iterable
    {
        $this->name = trans('akrbdk-news::admin.menu.categoriesTitle');

        $this->categoryExists = $category->exists;

        if($this->categoryExists){
            $this->name = $category->title;
        }

        return [
            'category' => $category
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(trans('akrbdk-news::admin.orchid.back'))
                ->icon('bn.arrow-left-circle')
                ->route('platform.news.category.list'),
            Button::make(trans('akrbdk-news::admin.orchid.delete'))
                ->icon('bn.trash')
                ->method('deleteCategory')
                ->confirm(trans('akrbdk-news::admin.orchid.deleteConfirm'))
                ->canSee($this->categoryExists)
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            EditLayout::class
        ];
    }

    public function saveCategory(Request $request): RedirectResponse
    {
        return resolve(NewsOrchidService::class)->saveCategory($this->category, $request);
    }

    public function deleteCategory(Category $category): RedirectResponse
    {
        resolve(CategoryRepository::class)->delete($category)
            ? Toast::info(trans('akrbdk-news::admin.orchid.success'))
            : Toast::warning(trans('akrbdk-news::admin.orchid.error'));

        return redirect()->route('platform.news.category.list');
    }
}
