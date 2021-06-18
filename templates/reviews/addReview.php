<?php include __DIR__ . '/../header.php'; ?>
<div class="main-page-wrapper">
	<form action="/reviews/addReview" method="post" enctype="text">
		<h1>Добавить отзыв</h1>
		<label for="author">Укажите имя(латинские буквы)</label><br>
		<input type="text" name="author" id="author" pattern="^[a-zA-Z\s]+$" value="<?= $_POST['author'] ?? '' ?>" size="50" required><br>
		<br>
		<label for="mail">Укажите email</label><br>
		<input type="email" name="mail" id="mail" value="<?= $_POST['mail'] ?? '' ?>" size="50" required><br>
		<br>
		<label for="reviewText">Введите отзыв</label><br>
		<textarea name="reviewText" id="reviewText" rows="10" cols="80" pattern='[a-zA-Z0-9]+' required><?=  $_POST['reviewText'] ?? '' ?></textarea><br>
		<br>
		<div class="g-recaptcha" data-callback="checkCaptcha" data-sitekey="6Lc1nz8bAAAAABQwpTLwYIUGkN6KYkVat0kQMeTV"></div><br>
		<input class="submit" type="submit" name="Добавить" value="Добавить" disabled>
	</form>
</div>
</body>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src='/../js/reCahtcha.js'></script>
</html>
