<?php include __DIR__ . '/../header.php'; ?>
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
				</div>
			</article>
		<?php endforeach; ?>
		<?php $i = 1; while ( $i <= $listCount) {?>
			<a class="pages" href="/reviews/<?php print($i) ?>"><?php print($i); ?></a>
		<?php $i++; }; ?>
		<div class="add-review">
			<a href="/reviews/addReview">Добавить отзыв</a>
		</div>
	</section>
</div>