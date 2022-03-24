<?php
class PostController {
    public function posts() {
        $posts = Post::all();

        view('posts-list', ['posts' => $posts]);
    }

    public function post() {
        


        if(Post::exists($_GET['post_id']))
        {
            $post = Post::load($_GET['post_id']);
            view('post', ['post' => $post]); 
        }
        else
        {
            redirect('timeline');
        }
    }

    public function createPost()
    {
        $user_id = Auth::id();
        $content = $_POST['post_content'];

        $post = new Post();
        $post->post_user_id = $user_id;
        $post->post_content = $content;
        $post->create();

        redirect('timeline');
    }

    public function deletePost()
    {
		$post_id = $_GET['post_id'];
		
		Post::destroy($post_id);

		redirect('timeline');
    }
}