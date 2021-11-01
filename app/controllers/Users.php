<?php
class Users extends Controller
{
    private $userModel = null;

    public function __construct()
    {
        $this->userModel = $this->model('User');
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
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = "Email format is invalid ex : user@email.com";
            } else if ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = "Email is already taken.";
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
                //if data is Validated

                //password_hash
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user
                if ($this->userModel->create($data)) {
                    //using the flash message function
                    flash('register_success', 'You are registerd and can log in');
                    //Redirect to users/login
                    redirect('users/login');
                } else {
                    die('Something wrong');
                }
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

            //check for email
            if ($this->userModel->findUserByEmail($data['email'])) {
                //User found
            } else {
                //User not found
                $data['email_err'] = 'User not found';
            }

            //Make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {

                //check and set logged user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {

                    //Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
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

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('pages/index');
    }

    //logout method
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('users/login');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
