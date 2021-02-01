<?php

// Настройки

/** @var string[] WHITE_LIST Список разрешенных типов и расширений файлов. */
define('WHITE_LIST', ['jpeg', 'jpg', 'png']);
/** @var int MIN_FILE_SIZE Мнимальный размер загружаемого файла. */
define('MIN_FILE_SIZE', 0);
/** @var int MIN_FILE_SIZE Максимальный размер загружаемого файла. */
define('MAX_FILE_SIZE', 1000000);
/** @var string IMAGE_WIDTH Ширина картинки в превью галереи. */
define('IMAGE_WIDTH', '150px');

/** @var string $photos Индексный массив с картинками. */
$photos = @array_splice(scandir(__DIR__ . '/upload/'), 2);
/** @var string $messages Ассоциативный массив с сообщениями о результатах обработки загружаемго файла. */
$messages = [
    'ok' => 'Файл загружен.',
    'error' => 'Ошибка загрузки.',
    'size' => 'Неправильный размер файла. Смотрите подсказку в форме.',
    'type' => 'Неправильный тип файла. Смотрите подсказку в форме.',
    'extention' => 'Неправильное расширение файла. Смотрите подсказку в форме.',
];

// Обработать пришедший на сервер файл
if (!empty($_FILES)) {
    /** @var string $fileName Пользовательское имя файла. */
    $fileName = $_FILES['picture']['name'];
    /** @var string $pathToTmpFile Путь к файлу во временной папке */
    $pathToTmpFile = $_FILES['picture']['tmp_name'];
    /** @var string $extension Расширение загружаемого файла */
    $extension = pathinfo($fileName)['extension'];
    /** @var string $pathToFile Путь к папке, куда будет помещен загружаемый файл с новым именем */
    $pathToFile = __DIR__ . "/upload/" . date('Y-m-d H:i:s', time()) . "." . $extension;

    // Проверить загружаемый файл на соотвествие настройкам
    if (!checkFileSize($pathToTmpFile, MIN_FILE_SIZE, MAX_FILE_SIZE)) {
        header("Location: index.php?message=size");
        exit();
    } elseif (!checkFileExtention($fileName, WHITE_LIST)) {
        header("Location: index.php?message=extention");
        exit();
    } elseif (!checkMimeType($pathToTmpFile, WHITE_LIST)) {
        header("Location: index.php?message=type");
        exit();
    }

    // Загрузить файл в папку на сайте
    if (move_uploaded_file($_FILES['picture']['tmp_name'], $pathToFile)) {
        header("Location: index.php?message=ok");
        exit();
    } else {
        header("Location: index.php?message=error");
        exit();
    }
}

// Определить переменную с соощением
$message = isset($_GET['message']) ? $messages[$_GET['message']] : null;

/**
 * Функция определяет, находится ли размер файла
 * в указанных границах
 *
 * @param string $pathToFile путь к файлу
 * @param int $minSize начальное значение границы размера
 * @param int $maxSize конечное значение границы размера
 *
 * @return bool true - соответствует; false - не соответствует
 */
function checkFileSize($pathToFile, $minSize, $maxSize): bool
{
    $fileSize = filesize($pathToFile);

    if ($fileSize >= $minSize && $fileSize <= $maxSize) {
        return true; 
    }

    return false;
}

/**
 * Функция определяет MIME-тип изображения
 *
 * @param string $pathToImage путь к файлу изображения
 * @param array $whiteList белый список типов
 *
 * @return string|bool вернет MIME-тип или false
 */
function checkMimeType(string $pathToImage, array $whiteList)
{
    $mimeType = image_type_to_mime_type(exif_imagetype($pathToImage));

    foreach ($whiteList as $item) {
        if(preg_match("#\/$item#i", $mimeType)) {
           return true;
        }
    }
    return false;
}

/**
 * Функция проверяет расширение файла изображения
 * на наличие его в белом списке
 *
 * @param string $fileName имя файла ($_FILE['file']['name'])
 * @param array $whiteList индексный массив с разрешенными расширениями файлов
 *
 * @return bool true- проверка пройдена; false - проверка не пройдена
 *
 */
function checkFileExtention(string $fileName, array $whiteList): bool
{
    foreach ($whiteList as $item) {
        if(preg_match("/$item\$/i", $fileName)) {
           return true;
        }
    }

    return false;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Галерея</title>
</head>

<body>
<section>
<h1>Галерея</h1>

<?php if (empty($photos)): ?>
<p>Помогите нам создать галерею! Загрузите картинки!</p>
<?php endif; ?>

<?php foreach ($photos as $photo): ?>
<a href="upload/<?= $photo; ?>" target="_blanc">
    <img src="upload/<?= $photo; ?>" alt="" width="<?= IMAGE_WIDTH ?>">
</a>

<?php endforeach; ?>
</section>

<section>
<h3>Загрузить файл на сервер</h3>

<?php if (!empty($message)): ?>
<p><?= $message ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="picture">
    <p>Расширение и тип файла: <?= implode(', ', WHITE_LIST); ?>.</p>
    <p>Минимальный размер файла - <?= MIN_FILE_SIZE; ?> байт.</p>
    <p>Максимальный размер файла - <?= MAX_FILE_SIZE; ?> байт.</p>
    <input type="submit" value="Загрузить">
</form>
</section>
    
</body>
</html>
