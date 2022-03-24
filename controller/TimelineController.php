<?php
class TimelineController {
    public function index() {
        $posts = Post::allOrdered();

        view('timeline', ['posts' => $posts]);
    }
}