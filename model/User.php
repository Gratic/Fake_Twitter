<?php
class User extends Model
{
	public static function getUserWithName($name)
	{
		$statement = "select * from user where user_name = ?";
		$statement = db()->prepare($statement);
		$statement->execute([$name]);

		if($data = $statement->fetch())
		{
			$user = new User();
			$user->fillAttributes($data);
			return $user;
		}
		else
		{
			return false;
		}
	}
}