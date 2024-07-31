<nav id="nav">
    <ul>
        @if(!empty($categories))
            @foreach($categories as $category)
                <li>
                    <a href="#{{ $category['alias'] }}" @if ($loop->first) class="active" @endif>
                        {{ $category['title'] }}
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</nav>

<div id="main">

    @if(!empty($categories))
        @foreach($categories as $category)
            <section id="{{ $category['alias'] }}" class="main">
                @foreach($category->elements as $element)
                    <div class="spotlight">
                        <div class="content">
                            <header class="major">
                                <h2>
                                    {{ $element['title'] }}
                                </h2>
                                <h3>
                                    {{ $category['title'] }} | {{ $element->publishDateFormat }}
                                </h3>
                            </header>
                            <p>
                                {{ $element['preview_text'] }}
                            </p>
                            <ul class="actions">
                                <li>
                                    <a href="{{ $element->url }}" class="button">Read More</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </section>
        @endforeach
    @endif
</div>
