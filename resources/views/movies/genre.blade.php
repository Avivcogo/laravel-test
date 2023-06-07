@include('html-start')

    <h1>Action movies</h1>

    <ul>
        <?php foreach ($movies as $movie) : ?>
            <li>
                <?= $movie->name ?>
                (<?= $movie->year ?>)

                <?= $movie->movieType->name ?>

                Genres:
                <?php foreach ($movie->genres as $genre) : ?>
                    <?= $genre->name ?>
                <?php endforeach; ?>
            </li>
        <?php endforeach; ?>
    </ul>

@include('html-end')