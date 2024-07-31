<?php

namespace Akrbdk\News\Http;

use Akrbdk\News\View\Components\ItemCard\ItemCard;
use App\Http\Controllers\Controller;

class ElementController extends Controller
{
    public function __invoke()
    {
        return resolve(ItemCard::class)->render();
    }
}
