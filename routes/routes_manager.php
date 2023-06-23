<?php

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;

//$app = new \app\core\Application(); -> senza use si istanzia Application scrivendo il package
$app = new Application(dirname(__DIR__));

$app->router->addRoute('get', '/', array(new SiteController(), 'home'));

$app->router->addRoute('get', '/contact', array(new SiteController(), 'showContact'));
$app->router->addRoute('post', '/contact', array(new SiteController(), ''));

$app->router->addRoute('get', '/login', array(new AuthController(), 'showLogin'));
$app->router->addRoute('post', '/login', array(new AuthController(), ''));

$app->router->addRoute('get', '/register', array(new AuthController(), 'showRegister'));
$app->router->addRoute('post', '/register', array(new AuthController(), ''));
$app->run();