@include('html-start')

    <h1>{{ $movie->name }}</h1>

    <div class="year">
        <?= $movie->year ?>
    </div>


    @if ($movie->rating > 8)
        <h2>Top rated movie</h2>
    @else
        <h2>Not among the top rated movies</h2>
    @endif

    <h2>Genres</h2>

    <?= $movie->genres->pluck('name')->join(', ') ?>

    <h2>Languages</h2>

    <?= $movie->languages->pluck('name')->join(', ') ?>

    <h2>Countries of origin</h2>

    <?= $movie->originCountries->pluck('name')->join(', ') ?>

    <h2>Cast & crew</h2>

    @foreach ($people as $position_name => $position_people)

        <h3><?= $position_name ?></h3>

        <ul>
            @foreach ($position_people as $person)
                <li>
                    <?= $person->fullname ?>
                </li>
            @endforeach
        </ul>

    @endforeach

@include('html-end')