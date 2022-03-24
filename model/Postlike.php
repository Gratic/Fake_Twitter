<?php
class Postlike extends Model {
    public static function getAllLikesOfPost($post_id) {
        $statement = "select * from postlike where post_id = :id";
		$statement = db()->prepare($statement);
		$statement->execute(["id" => $post_id]);

        $likes = [];

        foreach ($statement as $row) {
            $postlike = new Postlike();
            $postlike->fillAttributes($row);
            $likes[] = $postlike;
        }

        return $likes;
    }

    public static function getAllUsersWhoLikedPost($post_id) {
        $statement = "select user_name from user where user_id IN (select user_id from postlike where post_id = :post_id)";
        $statement = db()->prepare($statement);
        $statement->execute(["post_id" => $post_id]);

        $usernames = [];
        foreach ($statement as $row) {
            $usernames[] = $row['user_name'];
        }

        return $usernames;
    }

    public static function userHasLikedPost($user_id, $post_id)
    {
        $statement = "select '' from postlike where post_id = :post_id and user_id = :user_id";
        $statement = db()->prepare($statement);
        $statement->execute(["user_id" => $user_id, "post_id" => $post_id]);

        return !empty($statement->fetch());
    }
}