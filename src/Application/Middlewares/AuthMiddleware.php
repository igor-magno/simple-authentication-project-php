<?php

namespace Src\Application\Middlewares;

use Throwable;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Src\Application\Request;
use Src\Domain\Entities\Auth;
use Src\Application\Response;
use Src\Application\Services\UserService;
use Src\Infra\Repositories\UserMySqlRepository;

class AuthMiddleware implements Middleware
{
    public function execute(Request $req, Response $res): void
    {
        try {
            if (isset($_COOKIE['auth_token'])) {
                $token = $_COOKIE['auth_token'];
            } else {
                Response::redirectForce('/auth/login?error=Sua seção expirou!, realize o login novamente.');
            }
            
            JWT::decode($token, new Key($_ENV['KEY'], 'HS256'));

            $userRepository = new UserMySqlRepository();
            $userService = new UserService($userRepository);
            $user = $userService->findByToken($token);

            Auth::setUser($user);
        } catch (Throwable $th) {
            Response::redirectForce('/auth/login?error=' . $th->getCode() . ' - ' . $th->getMessage());
        }
    }
}
