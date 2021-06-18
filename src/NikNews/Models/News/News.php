<?php

namespace NikNews\Models\News;

use NikNews\Models\News\NewsEntity;

class News extends NewsEntity //Функции для работы с бд для новостей
{
	//список перемеснных для передачи и получения из бд
	protected $articleName;

	protected $description;

	protected $createAt;

	protected $newsStatus;

	protected $viewsCount;

	protected $img;

	protected static function getTableName(): string //название таблицы новостей для универсальных функций
	{
		return 'news_list';
	}
	//получение значения атрибутов полученых масивом из бд новостей
	public function getId(): int 
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->articleName;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getDate()
	{
		return $this->createAt;
	}

	public function getStatus() 
	{
		return $this->status;
	}

	public function getViews()
	{
		return $this->viewsCount;
	}

	public function getImg()
	{
		return $this->img;
	}

	public static function getSort()
	{
		return $this->sort;
	}
	//замена значений для обновления бд
	public function setName(string $name)
	{
		$this->article_name = $name;
	}

	public function setDescription(string $description)
	{
		$this->description = $description;
	}

	public function setPhoto($srcFileName)
	{
		$this->img = $srcFileName;
	}

	public function setStatus($status): int
	{
		$this->news_status = $status;
	}

	public function setViews($views)
	{
		$this->views_count = $views;
	}

	public static function createFromArray(array $fields): News//фунция для добавления новой записи в бд
	{
		$news = new News ();//новый объект
		$news->setName($fields['name']);//имя нового объекта
		$news->setDescription($fields['description']);//текст нового объекта
		$news->setPhoto($fields['photo']);//фото нового объекта

		$news->save(); //вызов универсальной функции для отправки запроса в бд на добавление новой новости

		return $news;
	}
}