@include('html-start')

    <h1>Search results</h1>

    <h2>Search term: <?= $search_term ?></h2>

    <form action="/search" method="get">
        <input type="text" name="search" value="<?= htmlspecialchars($search_term) ?>">
        <button>Search</button>
    </form>

    <ul>
        <?php foreach ($results as $movie) : ?>
            <li>
                <?= $movie->name ?>
                (<?= $movie->year ?>)
            </li>
        <?php endforeach; ?>
    </ul>

@include('html-end')