<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/jogodobicho/app/controllers/HomeController.php';
use \App\Controllers\HomeController;
$routes = [
    '/jogodobicho/' =>
        (new HomeController()),
    '/jogodobicho/login' => (new HomeController())
];