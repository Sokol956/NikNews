<?php include __DIR__ . '/../header.php'; ?>
<div class="main-page-wrapper">
	<div class="News">
		<h1><?= $news->getName() ?></h1><br><br>
		<?php if ($news->getImg() != null): ?>

		<img src="/../img/newsImage/<?= $news->getImg() ?>">

		<?php else: ?>

		<?php endif ?>
		<p><?= $news->getDescription() ?></p><br>
		<p>Новость от "<?= $news->getDate() ?>"</p><br>
		<p>Эту новость посмотрело <?= $news->getViews() ?> человек</p>
	</div>
</div>
</body>
</html>