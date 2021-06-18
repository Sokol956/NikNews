<?php

namespace NikNews\Controllers;

use NikNews\Models\News\News;
use NikNews\View\View;

class NewsController extends AbstractController
{	

	public function mainPage(int $page)//вывод главной страницы для гостей
	{
		$role = 'guest';//роль гость
		session_start();//началть сесию для сохранения сортировки

		if (empty($_SESSION['sort'])) {//если не от тортировки по умолчанию от новых записей
			$_SESSION['sort'] = 'sortNew';
		}

		if (isset($_POST['sort'])) {//если в сесии есть сортировки то применяется она
    	$_SESSION['sort'] = $_POST['sort'];
		} 

		if ($page == 1) {//определение с какой страницы новости
			$first = 0;
		} else {
			$first = 10 * ($page - 1);
		}
		$news = News::findAll($first, $_SESSION['sort'], $role);//запрос в бд для получения новостей по роли(гостям только опубликованыне)
		$this->view->renderHtml('news/main.php', ['news' => $news['0'], 'listCount' => $news['1']]);//отрисовка страницы
	}

	public function adminMainPage(int $page)//вывод главной страницы администратора
	{	
		$role = 'admin';
		session_start();

		if (empty($_SESSION['sort'])) {
			$_SESSION['sort'] = 'sortNew';
		}

		if (isset($_POST['sort'])) {
    	$_SESSION['sort'] = $_POST['sort'];
		}
		if ($page == 1) {
			$first = 0;
		} else {
			$first = 10 * ($page - 1);
		};
		$news = News::findAll($first, $_SESSION['sort'], $role);
		$this->view->renderHtml('news/adminMain.php', ['news' => $news['0'], 'listCount' => $news['1']]); 
	}

	public function news(int $newsId)//вывод новости для гостя
	{
		$news = News::getByIdGuest($newsId);
		$this->view->renderHtml('news/news.php', ['news' => $news]);
	}

	public function adminNews(int $newsId)//Вывод новости для админа с возможностью опубликовать и удалить новость
	{
		$news = News::getById($newsId);

		$this->view->renderHtml('news/adminNews.php', ['news' => $news]);
	}

	public function addNews(): void //Вывод страницы для добавления новой новости
	{

		if(!empty($_POST)) {//елси переданы данные из формы
			$role='admin';//роль админ

			$upOne = realpath(__DIR__ . '/../../..');//путь к дериктории
			$file = $_FILES['photo'];//получить масив с атрибутами фото
			$srcFileName = $file['name'];//получение имени файла
			$newFileSrc = $upOne . '/www/img/newsImage/' . $srcFileName;//место положение папки куда поместить файл
			move_uploaded_file($file['tmp_name'], $newFileSrc);//перемещение полученного файла в папку
			$_POST['photo'] = $file['name'];//добавление в масив ПОСТ имений файла дла передачи в базу
			$news = News::createFromArray($_POST);//вызов функции для добавления записи в бд

			$news = News::findAll('0', 'sortNew', $role);
			$this->view->renderHtml('news/adminMain.php', ['news' => $news['0'], 'listCount' => $news['1']]); 
		} else {
			$this->view->renderHtml('news/addNews.php');
		}
		
	}

	public function newsDelete(int $newsId)//Удаление записи
	{
		$role='admin';
		$news = News::delete($newsId);
		$news = News::findAll('0', 'sortNew', $role);
		$this->view->renderHtml('news/adminMain.php', ['news' => $news['0'], 'listCount' => $news['1']]);
	}

	public function newsPublish(int $newsId)//Публикация записи
	{
		$role='admin';
		$news = News::publish($newsId);
		$news = News::findAll('0', 'sortNew', $role);
		$this->view->renderHtml('news/adminMain.php', ['news' => $news['0'], 'listCount' => $news['1']]);
	}
}