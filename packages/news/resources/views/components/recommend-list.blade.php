<section class="special">
    <br>
    <h1>Related News</h1>
</section>

@foreach($elements as $element)
    <section class="main special">
        <h2>
            {{ $element->title }}
        </h2>
        <h3>
            {{ $element->publishDateFormat }}
        </h3>

        <p class="content">
            {{ $element->preview_text }}
        </p>

        <footer class="major">
            <ul class="actions special">
                <li><a href="{{ $element->url }}" class="button">Read more</a></li>
            </ul>
        </footer>

    </section>
@endforeach
