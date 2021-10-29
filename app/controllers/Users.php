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
            /////Process form/////

            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm-password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''

            ];

            //Validate name
            if (empty($data['name'])) {
                $data['name_err'] = "Please enter name";
            }

            //Validate email
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter email";
            }

            //Validate password
            if (empty($data['password'])) {
                $data['password_err'] = "Please enter password";
            } elseif (strlen($data['password']) > 6) {
                $data['password_err'] = "Password must be at least 6 characters";
            }

            //Validate confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = "Please confirm password";
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = "Passwords do not match";
            }

            //Make sure errors are empty
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                die('success');
            } else {
                //load view
                $this->view('users/register', $data);
            }
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

            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init Data
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'email_err' => '',
                'password_err' => '',
            ];

            //Validation email
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter email";
            }

            //Validate password
            if (empty($data['password'])) {
                $data['password_err'] = "Please enter password";
            }

            //Make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                die('success');
            } else {
                //load view
                $this->view(
                    'users/login',
                    $data
                );
            }
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
