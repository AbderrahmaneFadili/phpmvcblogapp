<?php

/**
 * App Core Class
 * Creates URL & loads Core Controller
 * URL Format : Controller/method/param
 */

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        //look in controllers for first value
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {

            //if exists
            $this->currentController = ucwords($url[0]);
            //Unset 0 index
            unset($url[0]);
        }

        //Require the Controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        //Instantiate controller class
        $this->currentController = new $this->currentController();

        //check for second part of url
        if (isset($url[1])) {
            //check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                //Unset 0 index
                unset($url[1]);
            }
        }



        //Get params
        $this->params = $url ? array_values($url) : [];

        //call a callback with array of params
        //Ex Users::index($id)
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }


    public function getUrl()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
