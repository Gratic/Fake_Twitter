<?php
unflash();

$app = new App();
$connected = Auth::check();

$app->route('home', 'HomeController', 'home');
$app->route('legit', 'LegitController', 'index');
$app->route('timeline', 'TimelineController', 'index');
$app->route('post', 'PostController', 'post');
$app->route('cursorjacking', 'cursorjackingController', 'cursorjacking');

if(!$connected)
{
	$app->route('inscription', 'UserController', 'userInscriptionForm');
	$app->route('inscription-post', 'UserController', 'userAdd');
	$app->route('connexion', 'UserController', 'userConnexionForm');
	$app->route('connexion-post', 'UserController', 'userConnexion');
}
if($connected)
{
	$app->route('deconnexion', 'UserController', 'userDeconnexion');

	$app->route('post-form-post', 'PostController', 'createPost');
	$app->route('post-delete', 'PostController', 'deletePost');

	$app->route('postlike-create', 'PostlikeController', 'create');
	$app->route('postlike-delete', 'PostlikeController', 'delete');
}

$app->route('user-delete', 'UserController', 'userDelete');

if(!$app->page_found)
	view("404");
