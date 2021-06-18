<?php include __DIR__ . '/../adminheader.php'; ?>
<div class="main-page-wrapper">
	<section class="main-page-filters">
		<h1>Фильтры:</h1>
		<form name="sort" method="post" action="/admin/1">
			<div>
				<input type="radio" id="new" name="sort" value="sortNew">
				<label for="new">От новых к старым</label><br>
			</div>
			<div>
				<input type="radio" id="old" name="sort" value="sortOld">
				<label for="old">От старых к новым</label><br>
			</div>
			<div>
				<input type="radio" id="popular" name="sort" value="sortPopular">
				<label for="sortPopular">От популярных</label><br>
			</div>
			<div>
				<input type="radio" id="notpopular" name="sort" value="sortNotPopular">
				<label for="sortNotPopular">От не популярных</label><br>
			</div>
			<button type="submit">Отсортировать</button><br><br>
		</form>
		<hr><br>
		<a href="/admin/addNews">Добавить новость</a>
	</section>
	<section class="main-page-news">
		<?php foreach ($news as $oneNews): ?>
			<article>
				<div class="news-wrap">
					<div class="news-date"><?= $oneNews->getDate() ?></div>
					<div class="news-article"><a href="/admin/news/<?= $oneNews->getId() ?>"><?= $oneNews->getName() ?></a></div>
					<div class="news-views">Просмотров: <?= $oneNews->getViews() ?></div>
					<div class="news-views">Дата публикации: <?= $oneNews->getDate() ?></div>
				</div>
			</article>
		<?php endforeach; ?>
		<div class="pages-wrap">
			<?php $i = 1; while ( $i <= $listCount) {?>
				<a class="pages" href="/admin/<?php print($i) ?>"><?php print($i); ?></a>
				<?php $i++; }; ?>
			</div>
		</section>
	</div>
</body>
</html>