<?php
class Pages
{
    public function __construct()
    {
        //echo 'Pages loaded';
    }

    public  function index($id = null)
    {
        echo "home , id : $id";
    }

    public function about()
    {
        echo 'about';
    }
}
