<?php

/**
 *  Base Controller 
 *  Loads the models & the views
 *  */

class Controller
{
    //load model
    public  function model($model)
    {
        //Require model file
        require_once "../app/models/" . $model . ".php";

        //Instantiat model
        return new $model();
    }

    //load view
    public function view($view, $data = [])
    {
        //check for the view file
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            //View does not exist
            die('View does not exist');
        }
    }
}
