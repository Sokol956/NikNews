<?php include __DIR__ . '/../adminheader.php'; ?>
<div class="main-page-wrapper">
	<form action="/admin/addNews" method="post" enctype="multipart/form-data">
		<h1>Добавление новой новости</h1>
		<label for="name">Заголовок</label><br>
		<input type="text" name="name" id="name" value="<?= $_POST['name'] ?? '' ?>" size="50" required><br>
		<br>
		<label for="description">Текст новости</label><br>
		<textarea name="description" id="description" rows="10" cols="80" required><?=  $_POST['description'] ?? '' ?></textarea><br>
		<br>
		<label for="photo">Фото</label><br>
		<input type="file" name="photo">
		<br><br>
		<input type="submit" name="Добавить" value="Добавить">
	</form>
</div>
</body>
</html>