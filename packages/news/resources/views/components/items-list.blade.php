<div>
    Items list Component
</div>
<div>
    <h1>Categories</h1>
    @if(!empty($categories))
        <ul>
            @foreach($categories as $category)
                <li>
                    {{ $category['title'] }}
                </li>
            @endforeach
        </ul>
    @endif

    <h1>Items</h1>
    @if(!empty($items))
        <ul>
            @foreach($items as $item)
                <li>
                    {{ $item->publishDateFormat }} - {{ $item['title'] }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
<br>
