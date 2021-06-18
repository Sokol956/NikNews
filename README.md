# NikNews
Функционал новостей и отзывов разделены в соответствующийх папках и файлах.
Новости:
  Контроллер в папке src\NikNews\Controllers\NewsContorller.php
  Модель в папке src\NikNews\Models\News
  Шаблоны в папке  templates\news
Отзывы:
  Контроллер в папке src\NikNews\Controllers\ReviewsController
  Модель в папке src\NikNews\Models\Reviews
  Шаблоны в папке templates\reviews
Универсальные функции обращений к DB в папке src\NikNews\Models\ActiveRecordEntity.php

От класа ActiveRecordEntity наследуются NewsEntity и NewsEntity, для больше модульности можно функции из ActiveRecordEntity переместить в соответствующие класы NewsEntity и NewsEntity,
но тогда будет повторятся одинаковый код, по этому оставил в ActiveRecordEntity то что используется в обоих модулях.
