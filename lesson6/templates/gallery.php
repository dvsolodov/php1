<section>
<h1>Галерея</h1>

<?php if (empty($photos)): ?>
<p>Помогите нам создать галерею! Загрузите картинки!</p>
<?php endif; ?>
<?php foreach ($photos as $photo): ?>
    <p class="gallery_pic">
        <a href="/picture/<?= $photo['id']; ?>">
            <img src="/images/gallery/small/<?= $photo['name']; ?>" alt="" width="<?= IMAGE_WIDTH ?>">
        </a>
        <span>Просмотров: <?= $photo['views']; ?></span>
    </p>
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
