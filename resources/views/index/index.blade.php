@include('html-start')

    @php
        $string = '<h1>Headline</h1>';
    @endphp

    {{ $string }}
    {!! $string !!}

    <!-- Comment in HTML (no sensitive info here) -->
    {{-- users are idiots --}}
    <h1>This is the homepage</h1>

    <h2>Top movies</h2>

    <ul>
        @foreach ($top_movies as $movie)
            <li>
                {{ $movie->name }}
                ({{ $movie->year }})

                - {{ $movie->rating }}/10
            </li>
        @endforeach
    </ul>

    <h2>Search for a movie:</h2>

    <form action="/search" method="get">
        <input type="text" name="search">
        <button>Search</button>
    </form>


@include('html-end')