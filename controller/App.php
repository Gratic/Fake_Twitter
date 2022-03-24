<?php

class App
{
	public $page_found = false;

	public function route($route, $controller, $action)
	{
		$path = "./controller/$controller.php";
		if(isset($_GET['route']) && $route == $_GET['route'] && file_exists($path))
		{
			(new $controller)->$action();
			$this->page_found = true;
		}
		else if(!isset($_GET['route']))
		{
			(new HomeController)->home();
			$this->page_found = true;
		}
		// else
		// 	die("Erreur : $path");
	}

}