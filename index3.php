<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/jogodobicho/routes/routes.php';

$uri = $_SERVER['REQUEST_URI'];
echo $uri;

if (isset($routes[$uri])) {
    $routes[$uri]->index();
} else {
    echo 'not found';
}
