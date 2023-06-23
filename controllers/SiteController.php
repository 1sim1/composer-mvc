<?php
namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\core\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => 'Simone',
            'surname' => 'Maccari'
        ];
        return $this->render('home', $params);
    }
    public function showContact()
    {
        return $this->render('contact');
    }
}