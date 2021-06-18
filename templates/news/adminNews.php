<?php include __DIR__ . '/../adminheader.php'; ?>
<div class="main-page-wrapper">
	<div class="news">
		<div class="news-wrap">
			<h1><?= $news->getName() ?></h1><br><br>
			<?php if ($news->getImg() != null): ?>

			<img src="/../img/newsImage/<?= $news->getImg() ?>">

			<?php else: ?>

			<?php endif ?>
		</div><br>
		<p><?= $news->getDescription() ?></p><br><br><br>
		<div class="news-wrap">
			<p class="news-views">Новость от "<?= $news->getDate() ?>"</p><br>
			<p class="news-views">Эту новость посмотрело <?= $news->getViews() ?> человек</p><br><br>
		</div>

		<?php if ($news->getStatus() == 0): ?>

		<p>Статус: Не опубликовано</p><br><br>
		<a href="/admin/news/<?= $news->getId() ?>/publish">Опубликовать</a><br><br>

		<?php else: ?>
		
		<p>Статус: Опубликовано</p><br><br>

		<?php endif ?>
		<a href="/admin/news/<?= $news->getId() ?>/delete">Удалить новость</a>
	</div>
</div>
</body>
</html>