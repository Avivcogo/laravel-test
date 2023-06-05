<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel IMDB project</title>

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <h1>This is the homepage</h1>

    <h2>Top movies</h2>

    <ul>
        <?php foreach ($top_movies as $movie) : ?>
            <li>
                <?= $movie->name ?>
                (<?= $movie->year ?>)

                - <?= $movie->rating ?>/10
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>