<?php

try {
	spl_autoload_register(function (string $className) {
	require_once __DIR__ . '/../src/' . $className . '.php';
	});

	$route = $_GET['route'] ?? '';
	$routes = require __DIR__ . '/../src/routes.php';

	$isRouteFound = false;
	foreach ($routes as $pattern => $controllerAndAction) {
		preg_match($pattern, $route, $matches);
		if (!empty($matches)) { 
			$isRouteFound = true; 
			break;
		}
}

	unset($matches[0]);
  $controllerName = $controllerAndAction[0];
 	$actionName = $controllerAndAction[1];

  $controller = new $controllerName();
  $controller->$actionName(...$matches);
} catch (\NikNews\Exceptions\DbException $e) {
  	$view = new \NikNews\View\View(__DIR__ . '/../templates/errors');
  	$view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
} catch (\NikNews\Exceptions\NotFoundException $e) {
  	$view = new \NikNews\View\View(__DIR__ . '/../templates/errors');
  	$view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
}