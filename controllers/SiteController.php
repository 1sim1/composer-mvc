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
    public function sendMessage()
    {
        $subject = $_POST['subject'];
        $email = $_POST['email'];
        $body = $_POST['body'];

        $subject = filter_var($subject, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $body = filter_var($body, FILTER_SANITIZE_SPECIAL_CHARS);

        $subject = trim($subject);
        $email = trim($email);
        $body = trim($body);

        $data = array($subject, $email, $body);

        $ret['cod'] = 0;
        $ret['dat'] = $data;
        $ret['msg'] = "Il messaggio $body è stato inviato correttamente dalla mail $email";

        echo json_encode($ret);
    }
}
