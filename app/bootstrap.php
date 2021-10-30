<?php
/*
 * Bootstrap is the first piece of code your web application runs. It loads all 
 * system components, and then runs your application. The component uses MVC 
 * application architecture.
 */

require_once "../app/config/config.php";

require_once '../app/helpers/url_helper.php';

//Autoload Core libraries
spl_autoload_register(function ($className) {
    require_once "../app/libraries/" . $className . ".php";
});



//Init Core Library
$init = new Core();
