<?php include __DIR__ . '/../adminheader.php'; ?>
<div class="main-page-wrapper">
	<div>
		<h1>Отзыв</h1><br><br>
		<p>Имя: <?= $review->getName() ?></p><br>
		<p>Почта: <?= $review->getEmail() ?></p><br>
		<p>Текст отзыва: <?= $review->getText() ?></p><br>
		<p>Дата добавления отзыва: <?= $review->getDate() ?></p><br><br><br><br>
		<a href="/admin/reviews/<?= $review->getId() ?>/moderate">Вернутся к редактированию</a><br>
		<a href="/admin/reviews/<?= $review->getId() ?>/publish">Обуликовать</a><br>
		<a href="/admin/reviews/1">К списку отзывов</a>
	</div>
</div>
</body>
</html>