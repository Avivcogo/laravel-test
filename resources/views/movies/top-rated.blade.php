@include('html-start')

    <h1>Top rated movies</h1>

    <ul>
        <?php foreach ($movies as $movie) : ?>
            <li>
                <?= $movie->name ?>
                (<?= $movie->year ?>)

                - <?= $movie->rating ?>/10
            </li>
        <?php endforeach; ?>
    </ul>

@include('html-end')