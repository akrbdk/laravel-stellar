@extends('layouts.app')

@section('body')
    <!-- Element card -->
    <div id="main">

        <section id="second" class="main special">

            <header class="major">
                <h2>
                    {{ $element->title }}
                </h2>
                <h3>
                    {{ $element->publishDateFormat }}
                </h3>
            </header>


            <p class="content">
                {!! $element->body_text !!}
            </p>

            <footer class="major">
                <ul class="actions special">
                    <li><a href="{{ route('index') }}" class="button">Back to News</a></li>
                </ul>
            </footer>

        </section>

        <!-- Recommend Section -->
        <x-akrbdk-news-recommendList :params="$recommendListDto ?? null"/>

    </div>
@endsection
