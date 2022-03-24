<?php
class Post extends Model {
    public static function getUserWithName($name)
	{
		$statement = "select * from post where user_name = ?";
		$statement = db()->prepare($statement);
		$statement->execute([$name]);

		$posts = [];

		foreach ($statement as $row)
		{
			$post = new Post();
			$post->fillAttributes($row);
			$posts[] = $post;
		}

		return empty($posts) ? false : $posts;
	}

    public static function allOrdered(){
		$class = strtolower(get_called_class());
		$statement = "select * from $class order by post_date desc";
		$statement = db()->query($statement);

		$os = [];
		foreach ($statement as $row) {
			$o = new $class();
			$o->fillAttributes($row);
			$os[] = $o;
		}

		return $os;
    }

    public function user(){
        return User::load($this->post_user_id);
    }

    public function postlikes() {
        return Postlike::getAllLikesOfPost($this->post_id);
    }
}