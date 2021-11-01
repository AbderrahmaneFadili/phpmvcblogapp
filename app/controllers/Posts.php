<?php
class Posts extends Controller
{

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->userModel = $this->model('Post');
    }

    //index
    public function index()
    {
        //Get posts
        $posts = $this->userModel->getPosts();

        $data = [
            "posts" => $posts
        ];

        $this->view('posts/index', $data);
    }

    //add
    public function add()
    {
        $data = [
            'title' => '',
            'body' => '',
            'title_err' => '',
            'body_err' => ''
        ];

        $this->view('posts/add', $data);
    }
}
