<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search results</title>
</head>
<body>

    <h1>Search results</h1>

    <h2>Search term: <?= $search_term ?></h2>

    <ul>
        <?php foreach ($results as $movie) : ?>
            <li>
                <?= $movie->name ?>
                (<?= $movie->year ?>)
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>