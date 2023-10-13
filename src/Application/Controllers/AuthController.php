<?php

namespace Src\Application\Controllers;

use Exception;
use Src\Application\Request;
use Src\Application\Response;
use Src\Application\Services\AuthService;
use Src\Application\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {
    }

    public function loginPage(Request $req, Response $res)
    {
        return $this->safeMode('/auth/login', $req, $res, function ($req, $res) {

            return $res->view('login');
        });
    }

    public function login(Request $req, Response $res)
    {
        return $this->safeMode('/auth/login', $req, $res, function ($req, $res) {

            $email = filter_var($req->get('email'), FILTER_SANITIZE_EMAIL);
            $password = $req->get('password');

            if ($email == null) throw new Exception('O e-mail informado não é valido! Corrija e tente novamente. Caso o problema persista entre em contato com o suporte.', 400);
            if ($password == null) throw new Exception('A senha informada não é valida! Corrija e tente novamente. Caso o problema persista entre em contato com o suporte.', 400);

            $this->authService->login($email, $password);

            return $res->redirect('/home');
        });
    }

    public function logout(Request $req, Response $res)
    {
        return $this->safeMode('/auth/login', $req, $res, function ($req, $res) {

            $this->authService->logout();
            return $res->redirect('/auth/login');
        });
    }
}
