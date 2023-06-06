<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $movie->name ?></title>
</head>
<body>

    <h1><?= $movie->name ?></h1>

    <div class="year">
        <?= $movie->year ?>
    </div>


    <?php if ($movie->rating > 8) : ?>
        <h2>Top rated movie</h2>
    <?php endif; ?>

    <h2>Genres</h2>

    <?= $movie->genres->pluck('name')->join(', ') ?>

    <h2>Languages</h2>

    <?= $movie->languages->pluck('name')->join(', ') ?>

    <h2>Countries of origin</h2>

    <?= $movie->originCountries->pluck('name')->join(', ') ?>

    <h2>Cast & crew</h2>

    <?php foreach ($people as $position_name => $position_people) : ?>

        <h3><?= $position_name ?></h3>

        <ul>
            <?php foreach ($position_people as $person) : ?>
                <li>
                    <?= $person->fullname ?>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php endforeach; ?>

</body>
</html>