<?php

namespace NikNews\Controllers;

use NikNews\Models\News\News;
use NikNews\View\View;

class MainController extends AbstractController 
{
	public function main()//вывод главной страницы для гостей кроме новостей что не опубликовал админ
	{
		$this->view->renderHtml('main/mainPage.php');
	}
}