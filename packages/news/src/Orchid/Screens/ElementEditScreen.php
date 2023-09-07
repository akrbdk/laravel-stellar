<?php

namespace Akrbdk\News\Orchid\Screens;

use Akrbdk\News\Models\Element;
use Akrbdk\News\Orchid\Layouts\Element\EditLayout;
use Akrbdk\News\Orchid\Services\NewsOrchidService;
use Akrbdk\News\Repositories\Contracts\ElementRepository;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ElementEditScreen extends Screen
{
    protected bool $existsElement = false;
    protected ?string $title = null;
    protected int $categoryId = 0;
    public ?Element $element = null;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Element $element): iterable
    {
        $this->name = trans('akrbdk-news::admin.menu.elementsTitle');
        $this->existsElement = $element->exists;
        $this->categoryId = (int)Route::current()->parameter('category_id');

        if($this->existsElement){
            $this->name = $element->title;
        }
        return [
            'element' => $element,
            'category_id' => $this->categoryId
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
                ->icon('bn.arrow-left')
                ->route('platform.news.element.list'),
            Button::make(trans('akrbdk-news::admin.orchid.delete'))
                ->icon('bn.trash')
                ->method('deleteElement')
                ->confirm(trans('akrbdk-news::admin.orchid.deleteConfirm'))
                //->canSee()
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

    public function saveElement(Request $request): RedirectResponse
    {
        return resolve(NewsOrchidService::class)->saveElement($this->element, $request);
    }

    public function deleteElement(Element $element, Request $request): RedirectResponse
    {
        resolve(ElementRepository::class)->delete($element)
            ? Toast::info(trans('akrbdk-news::admin.orchid.success'))
            : Toast::warning(trans('akrbdk-news::admin.orchid.error'));

        $this->categoryId = (int)Route::current()->parameter('category');

        return $this->categoryId
            ? redirect()->route('platform.news.category.element.list', ['category' => $this->categoryId])
            : redirect()->route('platform.news.element.list');
    }
}
