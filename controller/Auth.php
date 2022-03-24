<?php
class Auth
{
	public static function check()
	{
		return isset($_SESSION['Auth']) && isset($_SESSION['Auth']['isAuthed']) ? $_SESSION['Auth']['isAuthed'] : false;
	}

	public static function id()
	{
		return isset($_SESSION['Auth']) && isset($_SESSION['Auth']['id']) ? $_SESSION['Auth']['id'] : false;
	}

	public static function authentificate($id, $array_information = null)
	{
		Auth::deauthentificate();
		$_SESSION['Auth']['isAuthed'] = true;
		$_SESSION['Auth']['id'] = $id;

		if($array_information != null)
			$_SESSION['Auth']['informations'] = $array_information;
	}

	public static function deauthentificate()
	{
		unset($_SESSION['Auth']);
	}

	public static function information($key = null)
	{
		if(Auth::check())
		{
			if($key == null)
				return $_SESSION['Auth']['informations'];
			else
				return $_SESSION['Auth']['informations'][$key];
		}
		else
		{
			return false;
		}
	}
}