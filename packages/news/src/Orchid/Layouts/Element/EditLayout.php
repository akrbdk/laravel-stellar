<?php

namespace Akrbdk\News\Orchid\Layouts\Element;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;

class EditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        /*'id',
        'title',
        'alias',
        'sort',
        'preview_image',
        'main_image',
        'publish_date',
        'active_from',
        'active_to',
        'locale',
        'preview_text',
        'body_text'*/


        return [];
    }
}
