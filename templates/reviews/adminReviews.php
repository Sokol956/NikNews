<?php include __DIR__ . '/../adminheader.php'; ?>
<div class="main-page-wrapper">
	<section class="main-page-reviews">
		<?php foreach ($reviews as $review): ?>
			<article class="page-reviews-wrap">
				<div class="guest-info-wrap">
					<div class="guest-info">
						<h1><?= $review->getName() ?></h1>
						<p><?= $review->getDate() ?></p>
						<p><?= $review->getEmail() ?></p>
					</div>
				</div>
				<div class="guest-review">
					<div class="review-wrap">
						<p><?= $review->getText() ?></p>
					</div>
					<div class="review-admin">
							<?php if ($review->getStatus() == 0): ?>
							<p>Статус: Не опубликовано</p>
							<a href="/admin/reviews/<?= $review->getId() ?>/publish">Опубликовать</a>
							<a href="/admin/reviews/<?= $review->getId() ?>/delete">Удалить</a>
							<a href="/admin/reviews/<?= $review->getId() ?>/moderate">Редактировать</a>
							<?php else: ?>
							<p>Статус: Опубликовано</p>
							<a href="/admin/reviews/<?= $review->getId() ?>/delete">Удалить</a>
							<a href="/admin/reviews/<?= $review->getId() ?>/moderate">Редактировать</a>
							<?php endif ?>
						</div>
				</div>
			</article>
		<?php endforeach; ?>
		<?php $i = 1; while ( $i <= $listCount) {?>
			<a class="pages" href="/admin/reviews/<?php print($i) ?>"><?php print($i); ?></a>
		<?php $i++; }; ?>
	</section>
</div>