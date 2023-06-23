<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function showLogin()
    {
        return $this->render('login');
    }
    public function showRegister(Request $request)
    {
        return $this->render('register');
    }
}
