<?php include __DIR__ . '/../adminheader.php'; ?>
<div class="main-page-wrapper">
	<form action="/admin/reviews/<?= $review->getId() ?>/moderate" method="post" enctype="multipart/form-data">
		<h1>Модерирование</h1><br>
		<label for="author">Имя</label><br>
		<input type="text" name="author" id="author" value="<?= $_POST['author'] ?? $review->getName() ?>" size="50"><br>
		<br>
		<label for="mail">Email</label><br>
		<input type="text" name="mail" id="mail" value="<?= $_POST['mail'] ?? $review->getEmail() ?>" size="50"><br>
		<br>
		<label for="reviewText">Текст</label><br>
		<textarea name="reviewText" id="reviewText" rows="10" cols="80"><?=  $_POST['reviewText'] ?? $review->getText() ?></textarea><br>
		<br>
		<input type="submit" name="save" value="Сохранить">
	</form>
</div>
</body>
</html>