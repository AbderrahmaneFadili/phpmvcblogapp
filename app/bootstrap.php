<?php
/*
 * Bootstrap is the first piece of code your web application runs. It loads all 
 * system components, and then runs your application. The component uses MVC 
 * application architecture.
 */
require_once '../app/libraries/controller.php';
require_once '../app/libraries/core.php';
require_once '../app/libraries/database.php';

//Init Core Library
$init = new Core();
