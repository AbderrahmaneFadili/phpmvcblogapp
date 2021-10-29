<?php
class Users extends Controller
{
    public function __construct()
    {
    }

    //register method
    public function register()
    {
        //Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Process form
        } else {
            //Init Data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''

            ];
            $this->view('users/register', $data);
        }
    }

    //Login method
    public function login()
    {
        //Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Process form
        } else {
            //Init Data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];
            $this->view('users/login', $data);
        }
    }
}
