<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;
header('Access-Control-Allow-Origin: http://localhost:8080', false);
class AuthController extends Controller
{
    public function showLogin()
    {
        return $this->render('login');
    }
    public function showCredentials()
    {
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = trim($email);

        $ret['cod'] = 0;
        $ret['dat'] = $email;
        $ret['msg'] = "Login effettuato con la mail $email";
        echo json_encode($ret);
    }
    public function showRegister(Request $request)
    {
        return $this->render('register');
    }
}
