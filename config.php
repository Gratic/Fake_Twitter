<?php
spl_autoload_register(function($class)
{
	if(strpos($class, 'Controller') || $class == "App" || $class == "Auth")
	{
		include_once "./controller/" .$class .".php";
	}
	else
	{
		include_once "./model/" .$class .".php";
	}
});

$ROOT_DIR = __DIR__;

$host = 'localhost';
$db   = 'legitdb';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

function db()
{
	global $pdo;
	return $pdo;
}

function view($view, $vars_array = null)
{
	if($vars_array != null)
	{
		foreach ($vars_array as $var_name => $value) {
			$$var_name = $value;
		}
	}

	include_once "./view/$view.php";
}

function urlr($route){

	echo $ROOT_DIR . $route;
	
}

function url($route, $params = null, $echo = true)
{
	global $ROOT_DIR;
	if($echo)
	{
		if($params == null)
		{
			echo $ROOT_DIR . "/?route=$route";
		}
		else
		{
			$param_str = "";
			foreach ($params as $param_key => $value) {
				$param_str .= "&$param_key=$value";
			}
			echo $ROOT_DIR ."/?route=$route" . $param_str;
		}
	}
	else
	{
		if($params == null)
		{
			return $ROOT_DIR ."/?route=$route";
		}
		else
		{
			$param_str = "";
			foreach ($params as $param_key => $value) {
				$param_str .= "&$param_key=$value";
			}
			return $ROOT_DIR . "/?route=$route" . $param_str;
		}
	}
	
}

function session($key = null)
{
	if($key === null)
		return $_SESSION;
	else if (isset($_SESSION[$key]))
		return $_SESSION[$key];
	else
		return false;
}

function unflash()
{
	if(isset($_SESSION['flash']))
	{
		foreach ($_SESSION['flash'] as $live => $live_array) {
			if($live == 0)
			{
				foreach ($_SESSION['flash'][0] as $flash_key) {
					unset($_SESSION[$flash_key]);
				}
				unset($_SESSION['flash'][0]);
			}
			else
			{
				$_SESSION['flash'][$live - 1] = $_SESSION['flash'][$live];
				unset($_SESSION['flash'][$live]);
			}
		}
	}
}

function flash($key, $value, $live = 1)
{
	$_SESSION[$key] = $value;
	$_SESSION['flash'][$live][] = $key;
}

function redirect($link)
{
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = "?route=$link";

	header("Location: http://$host$uri/$extra");
	exit();
}