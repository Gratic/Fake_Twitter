<?php
class PostlikeController {
    public function create()
    {
        $post_id = $_POST['post_id'];
        $user_id = Auth::id();

        $postlike = new Postlike();
        $postlike->post_id = $post_id;
        $postlike->user_id = $user_id;
        $postlike->create();

        redirect('timeline');
    }

    public function delete()
    {
        $post_id = $_POST['post_id'];
        $user_id = Auth::id();

        $statement = "delete from postlike where post_id = :post_id and user_id = :user_id";
        $statement = db()->prepare($statement);
        $statement->execute(['post_id' => $post_id, 'user_id' => $user_id]);

        redirect('timeline');
    }
} 