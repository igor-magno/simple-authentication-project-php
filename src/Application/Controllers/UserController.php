<?php

namespace Src\Application\Controllers;

use DateTime;
use Throwable;
use Exception;
use Src\Application\Request;
use Src\Domain\Entities\Auth;
use Src\Application\Response;
use Src\Domain\Dtos\UserCreate;
use Src\Domain\Dtos\UserUpdate;
use Src\Application\Services\AuthService;
use Src\Application\Services\UserService;

class UserController
{
    public function __construct(
        private UserService $userService,
        private AuthService $authService
    ) {
    }

    private function safeMode(string $errorRoute, Request $req, Response $res, callable $process)
    {
        try {
            return $process($req, $res);
        } catch (Exception $e) {
            return $res->redirect($errorRoute . '?error=' . $e->getCode() . ' - ' . $e->getMessage());
        } catch (Throwable $th) {
            return $res->redirect($errorRoute . '?error=Ocorreu um erro de nossa parte, por favor entre em contato com o suporte, [code:' . $th->getCode() . ' - message:' . $th->getMessage() . ' - file:' . $th->getFile() . ']');
        }
    }

    public function registerPage(Request $req, Response $res)
    {
        return $res->view('register');
    }

    public function register(Request $req, Response $res)
    {
        return $this->safeMode('/user/register', $req, $res, function ($req, $res) {

            $name = $req->get('name');
            $email = $req->get('email');
            $document = $req->get('document');
            $password = $req->get('password');
            $birthDate = $req->get('birth-date');
            $passwordCheck = $req->get('password-check');

            try {
                $birthDate = new DateTime($birthDate);
            } catch (Throwable $th) {
                throw new Exception('A data informada não é valida!, corrija e tente novamente. Caso o problema persista entre em contato com o suporte.', 400);
            }

            if ($password != $passwordCheck) throw new Exception('As senhas informadas não são iguais! Corrija e tente novamente. Caso o problema persista entre em contato com o suporte.');

            $user = new UserCreate($name, $email, $document, $password, $birthDate);

            $this->userService->register($user);
            $this->authService->login($email, $password);

            return $res->redirect('/home');
        });
    }

    public function edit(Request $req, Response $res)
    {
        return $this->safeMode('/home', $req, $res, function ($req, $res) {

            return $res->view('edit', ['user' => Auth::user()]);
        });
    }

    public function update(Request $req, Response $res)
    {
        return $this->safeMode('/user/edit', $req, $res, function ($req, $res) {

            $id = $req->get('id');
            $name = $req->get('name');
            $email = $req->get('email');
            $document = $req->get('document');
            $birthDate = $req->get('birth-date');

            try {
                $birthDate = new DateTime($birthDate);
            } catch (Throwable $th) {
                throw new Exception('A data informada não é valida!, corrija e tente novamente. Caso o problema persista entre em contato com o suporte.', 400);
            }

            $user = new UserUpdate($id, $name, $email, $document, $birthDate);

            $this->userService->update($user);

            return $res->redirect('/home?success=Dados atualizados com sucesso.');
        });
    }

    public function updatePasswordPage(Request $req, Response $res)
    {
        return $this->safeMode('/home', $req, $res, function ($req, $res) {

            return $res->view('update-password', ['user' => Auth::user()]);
        });
    }

    public function updatePassword(Request $req, Response $res)
    {
        return $this->safeMode('/user/update-password', $req, $res, function ($req, $res) {

            $id = $req->get('id');
            $password = $req->get('password');
            $newPassword = $req->get('new_password');
            $confirmNewPassword = $req->get('confirm_new_password');

            $this->userService->updatePassword($id, $password, $newPassword, $confirmNewPassword);

            return $res->redirect('/home');
        });
    }

    public function updatePasswordById(Request $req, Response $res)
    {
        return $this->safeMode('/user/forgot-password-step-01', $req, $res, function ($req, $res) {

            $id = $req->get('id');
            $newPassword = $req->get('new_password');
            $confirmNewPassword = $req->get('confirm_new_password');

            $this->userService->updatePasswordById($id, $newPassword, $confirmNewPassword);

            return $res->redirect('/auth/login?success=Senha atualizada com sucesso, agora realize o login com sua nova senha.');
        });
    }

    public function remove(Request $req, Response $res)
    {
        return $this->safeMode('/home', $req, $res, function ($req, $res) {

            return $res->view('remove', ['user' => Auth::user()]);
        });
    }

    public function delete(Request $req, Response $res)
    {
        return $this->safeMode('/user/remove', $req, $res, function ($req, $res) {

            $this->userService->deleteById($req->get('id'));

            return $res->redirect('/auth/login');
        });
    }
    
    public function forgotPasswordStep01Page(Request $req, Response $res)
    {
        return $this->safeMode('/user/login', $req, $res, function ($req, $res) {

            return $res->view('forgot-password-step-01');
        }); 
    }
    
    public function forgotPasswordStep02Page(Request $req, Response $res)
    {
        return $this->safeMode('/user/forgot-password-step-01', $req, $res, function ($req, $res) {

            $email = $req->get('email');
            $user = $this->userService->findByEmail($email);
            return $res->view('forgot-password-step-02', ['user' => $user]);
        }); 
    }
}
