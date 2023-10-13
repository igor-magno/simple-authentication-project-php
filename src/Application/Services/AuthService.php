<?php

namespace Src\Application\Services;

use Exception;
use Firebase\JWT\JWT;
use Src\Application\Services\UserService;
use Src\Domain\Repositories\UserRepositoryInterface;

class AuthService
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private UserService $userService
    )
    {}

    public function login(string $email, string $password): void
    {
        $user = $this->repository->findByEmail($email);
        if($user == null) throw new Exception('O e-mail ou a senha estão incorretos!, verifique-os e tente novamente.');
        if(!password_verify($password, $user->password)) throw new Exception('O e-mail ou a senha estão incorretos!, verifique-os e tente novamente.');
    
        $expire = time() + 2000;
        $payload = [
            'exp' => $expire,
            'iat' => time(),
            'email' => $email,
        ];
        
        $token = JWT::encode($payload, $_ENV['KEY'], 'HS256');
        $success = setcookie('auth_token', $token, $expire, '/');

        if(!$success) throw new Exception('Não foi possível definir o cookie de autenticação! O acesso ao cookie pode estar bloqueado, desbloqueio e tente novamente. Caso o problema persista entre em contato com o suporte.', 500);
    
        $this->userService->updateTokenById($user->id, $token);
    }

    public function logout()
    {
        setcookie('auth_token', '', time() - 3600, '/');
    }
}
