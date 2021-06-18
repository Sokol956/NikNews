<?php

return [
		'~^$~' => [\NikNews\Controllers\MainController::class, 'main'],
		'~^page/(\d+)$~' => [\NikNews\Controllers\NewsController::class, 'mainPage'],
		'~^news/(\d+)$~' => [\NikNews\Controllers\NewsController::class, 'news'],
		'~^admin/(\d+)$~' => [\NikNews\Controllers\NewsController::class, 'adminMainPage'],
		'~^admin/news/(\d+)$~' => [\NikNews\Controllers\NewsController::class, 'adminNews'],
		'~^admin/news/(\d+)/delete$~' => [\NikNews\Controllers\NewsController::class, 'newsDelete'],
		'~^admin/addNews$~' => [\NikNews\Controllers\NewsController::class, 'addNews'],
		'~^admin/news/(\d+)/publish$~' => [\NikNews\Controllers\NewsController::class, 'newsPublish'],
		'~^reviews/(\d+)$~' => [\NikNews\Controllers\ReviewsController::class, 'mainReviews'],
		'~^reviews/addReview$~' => [\NikNews\Controllers\ReviewsController::class, 'addReview'],
		'~^admin/reviews/(\d+)$~' => [\NikNews\Controllers\ReviewsController::class, 'adminReviews'],
		'~^admin/reviews/(\d+)/publish$~' => [\NikNews\Controllers\ReviewsController::class, 'publishReviews'],
		'~^admin/reviews/(\d+)/delete$~' => [\NikNews\Controllers\ReviewsController::class, 'deleteReviews'],
		'~^admin/reviews/(\d+)/moderate$~' => [\NikNews\Controllers\ReviewsController::class, 'moderateReviews'],
];