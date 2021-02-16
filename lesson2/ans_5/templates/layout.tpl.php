<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? '' ?></title>
    <style>
        .active {
            color: red;
        }
    </style>
</head>
<body>
    <?= $menu ?? '' ?>
    <?= $content ?? '' ?>
</body>
</html>
