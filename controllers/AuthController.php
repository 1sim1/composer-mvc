<?php

namespace app\controllers;

use app\core\Controller;
use app\models\UserEntity;

header('Access-Control-Allow-Origin: http://localhost:8080', false);
class AuthController extends Controller
{
    public function showLogin()
    {
        return $this->render('login');
    }
    public function validateLoginCredentials()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);

        $email = trim($email);
        $password = trim($password);

        $userModel = new UserEntity();
        $user = $userModel->findUserByEmail($email);
        if ($user) {
            if ($user->password === $password) {
                $ret['cod'] = 0;
                $ret['dat'] = $user;
                $ret['msg'] = "Login effettuato con la mail $email";
            } else {
                $ret['cod'] = 1;
                $ret['dat'] = null;
                $ret['msg'] = "Credenziali non valide";
            }
        } else {
            $ret['cod'] = 1;
            $ret['dat'] = null;
            $ret['msg'] = "Nessun utente registrato con la mail $email";
        }
        echo json_encode($ret);
    }
    public function showRegister()
    {
        return $this->render('register');
    }
    public function validateRegisterCredentials()
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        $firstname = filter_var($firstname, FILTER_SANITIZE_SPECIAL_CHARS);
        $lastname = filter_var($lastname, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmPassword = filter_var($confirmPassword, FILTER_SANITIZE_SPECIAL_CHARS);

        $firstname = trim($firstname);
        $lastname = trim($lastname);
        $email = trim($email);
        $password = trim($password);
        $confirmPassword = trim($confirmPassword);

        if ($password === $confirmPassword) {
            $userModel = new UserEntity();
            $user = $userModel->findUserByEmail($email);
            if (!$user) {
                $userModel->addUser($firstname, $lastname, $email, $password);
                $validatedCredentials = array($firstname, $lastname, $email, $password, $confirmPassword);
                $ret['cod'] = 0;
                $ret['dat'] = $validatedCredentials;
                $ret['msg'] = "Registrazione effettuata con le credenziali $validatedCredentials[0], $validatedCredentials[1], $validatedCredentials[2], $validatedCredentials[3]";
            } else {
                $ret['cod'] = 1;
                $ret['dat'] = null;
                $ret['msg'] = "Esiste già un utente registrato con mail $email";
            }
        } else {
            $ret['cod'] = 1;
            $ret['dat'] = null;
            $ret['msg'] = "Le due password inserite non coincidono";
        }
        echo json_encode($ret);
    }
}
