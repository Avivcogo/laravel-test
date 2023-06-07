@include('html-start', ['title' => 'Top rated videogames'])

    <h1>Top rated videogames</h1>

    <ul>
        <?php foreach ($videogames as $videogame) : ?>
            <li>
                <?= $videogame->name ?>
                (<?= $videogame->year ?>)

                - <?= $videogame->rating ?>/10
            </li>
        <?php endforeach; ?>
    </ul>

@include('html-end')