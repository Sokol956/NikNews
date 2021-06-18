# NikNews
Функционал новостей и отзывов разделены в соответствующийх папках и файлах.<br><br>
Новости:<br><br>
  Контроллер в папке src\NikNews\Controllers\NewsContorller.php<br>
  Модель в папке src\NikNews\Models\News<br>
  Шаблоны в папке  templates\news<br><br>
Отзывы:<br><br>
  Контроллер в папке src\NikNews\Controllers\ReviewsController<br>
  Модель в папке src\NikNews\Models\Reviews<br>
  Шаблоны в папке templates\reviews<br><br>
Универсальные функции обращений к DB в папке src\NikNews\Models\ActiveRecordEntity.php<br><br>

От класа ActiveRecordEntity наследуются NewsEntity и NewsEntity, для больше модульности можно функции из ActiveRecordEntity переместить в соответствующие класы NewsEntity и NewsEntity, но тогда будет повторятся одинаковый код, по этому оставил в ActiveRecordEntity то что используется в обоих модулях.

Экспорт базы данных в папке \www, файлы news_list и reviews_list.
