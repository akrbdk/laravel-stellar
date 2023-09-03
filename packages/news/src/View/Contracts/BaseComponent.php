<?php

namespace Akrbdk\News\View\Contracts;

use Akrbdk\News\View\Contracts\ComponentAlias;
use Illuminate\View\Component;

abstract class BaseComponent extends Component implements ComponentAlias
{
    abstract protected function getRenderData(): iterable;
}
