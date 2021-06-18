<?php

namespace NikNews\Controllers;

use NikNews\Models\Reviews\Reviews;
use NikNews\View\View;

class ReviewsController extends AbstractController 
{
	public function mainReviews(int $page)//Список отзывов
	{
		$role = 'guest';//роль гостя
		if ($page == 1) {//определение страницы записи
			$first = 0;
		} else {
			$first = 10 * ($page - 1);
		}

		$reviews = Reviews::findAll($first, 'sortNew', $role);//запрос на получение списка отзывов
		$this->view->renderHtml('reviews/reviews.php', ['reviews' => $reviews['0'],'listCount' => $reviews['1']]);//отрисовка списка отзывов
	}

	public function adminReviews(int $page)//список отзывов для админа(включая не опубликованные)
	{
		$role = 'admin';//роль админа
		if ($page == 1) {
			$first = 0;
		} else {
			$first = 10 * ($page - 1);
		}

		$reviews = Reviews::findAll($first, 'sortNew', $role);
		$this->view->renderHtml('reviews/adminReviews.php', ['reviews' => $reviews['0'],'listCount' => $reviews['1']]);
	}

	public function addReview(): void //Добавление отзыва
	{
		if (!empty($_POST)) {

			$role = 'guest';//роль гость
			
			$url = "https://www.google.com/recaptcha/api/siteverify";//апи капчи
			$secret_key = '6Lc1nz8bAAAAANuev1TGNtfLpe2L1FONw95npJO5';//секретный ключ
			$query = $url.'?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];//запрос на обработку капчи
			$answer = json_decode(file_get_contents($query));//ответ обработанных данных

			if ($page == 1) {
				$first = 0;
			} else {
				$first = 10 * ($page - 1);
			}
			if ($answer->success == true){
				$review = Reviews::createFromArray($_POST);
				$reviews = Reviews::findAll(1, 'sortNew', $role);
				$this->view->renderHtml('reviews/reviews.php', ['reviews' => $reviews['0'],'listCount' => $reviews['1']]);
			} else {
				$this->view->renderHtml('reviews/addReview.php');
			}
			
		} else {
			$this->view->renderHtml('reviews/addReview.php');
		}
	}

	public function publishReviews(int $reviewId)//Публикация новости
	{
		
		$review = Reviews::publish($reviewId);
		$reviews = Reviews::findAll(0, 'sortNew', $role);
		$this->view->renderHtml('reviews/adminReviews.php', ['reviews' => $reviews['0'],'listCount' => $reviews['1']]);
	}

	public function deleteReviews(int $reviewId)//Удаление новости
	{
		$review = Reviews::delete($reviewId);
		$reviews = Reviews::findAll(0, 'sortNew', $role);
		$this->view->renderHtml('reviews/adminReviews.php', ['reviews' => $reviews['0'],'listCount' => $reviews['1']]);
	}

	public function moderateReviews(int $reviewId)//Модерирование новости(без капчи)
	{
		$review = Reviews::getById($reviewId);

		if(!empty($_POST)){//Если Пост не пустой обновить запись в бд и отрисовать страницу с новостью.
			$review->updateFromArray($_POST);
			$this->view->renderHtml('reviews/checkReview.php', ['review' => $review]);
		} else {
			$this->view->renderHtml('reviews/moderReviews.php', ['review' => $review]);
		}
	}
}