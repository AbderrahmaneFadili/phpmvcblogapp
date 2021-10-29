<?php
class Pages extends Controller
{

    public function __construct()
    {
        //echo 'Pages loaded';

    }

    public function index()
    {
        $data = [
            'title' => 'Welcome Home'
        ];
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Welcome About'
        ];
        $this->view('pages/about', $data);
    }
}
