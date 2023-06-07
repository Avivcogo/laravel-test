@include('html-start')

    <h1><?= $person->fullname ?></h1>

    <h2>Movies</h2>

    <?php foreach ($movies as $position_name => $position_movies) : ?>

        <h3><?= $position_name ?></h3>

        <ul>
            <?php foreach ($position_movies as $movie) : ?>
                <li>
                    <?= $movie->name ?>
                    (<?= $movie->year ?>)
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endforeach; ?>

@include('html-end')