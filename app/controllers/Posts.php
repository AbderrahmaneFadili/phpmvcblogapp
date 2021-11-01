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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' =>  trim($_POST['title']),
                'body' =>   trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            //Validated Data
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter body text';
            }


            //Make sure no errors
            if (empty($data['title_err']) && empty($data['body_err'])) {

                if ($this->userModel->addPost($data)) {
                    flash('post_message', 'Post Added');
                    redirect('posts');
                } else {
                    die('Something wrong');
                }
            } else {

                //load view with errors
                $this->view('posts/add', $data);
            }
        } else {

            $data = [
                'title' => '',
                'body' => '',
                'title_err' => '',
                'body_err' => ''
            ];

            $this->view('posts/add', $data);
        }
    }
}
