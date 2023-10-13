<?php

namespace Src\Application\Services;

use Exception;
use Src\Domain\Entities\User;
use Src\Domain\Dtos\UserCreate;
use Src\Domain\Dtos\UserUpdate;
use Src\Domain\Repositories\UserRepositoryInterface;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $repository
    ) {
    }

    public function register(UserCreate $user)
    {
        $password = password_hash($user->password, PASSWORD_BCRYPT);
        $birthDate = $user->birthDate->format('Y-m-d');
        $this->repository->create($user->name, $user->email, $password, $user->document, $birthDate);
    }

    public function update(UserUpdate $user)
    {
        $birthDate = $user->birthDate->format('Y-m-d');
        $this->repository->update($user->id, $user->name, $user->email, $user->document, $birthDate);
    }

    public function findByEmail(string $email): User
    {
        $user = $this->repository->findByEmail($email);
        if(!$user) throw new Exception('Usuário não encontrado!, verifique o e-mail e tente novamente.', 401);
        return $user;
    }

    public function findById(int $id): User
    {
        $user = $this->repository->findById($id);
        if(!$user) throw new Exception('Usuário não encontrado!, verifique o id e tente novamente.', 401);
        return $user;
    }


    public function findByToken(string $token): User
    {
        $user = $this->repository->findByToken($token);
        if(!$user) throw new Exception('Usuário não encontrado!, verifique o token e tente novamente.', 401);
        return $user;
    }

    public function deleteById(int $id)
    {
        $user = $this->repository->findById($id);
        if(!$user) throw new Exception('Usuário não encontrado!, verifique o id e tente novamente.', 401);
        $this->repository->deleteById($id);
        setcookie('auth_token', '', time() - 3600, '/');
    }

    public function updateTokenById(int $id, string $token)
    {
        $this->repository->updateTokenById($id, $token);
    }

    public function updatePassword(int $id, string $password, string $newPassword, string $confirmNewPassword)
    {
        $user = $this->findById($id);
        if(!password_verify($password, $user->password)) throw new Exception('A senha atual não está correta!, caso não lembre sua senha você pode solicitar a redefinição por e-mail. Caso o problema persista entre em contato com o suporte.', 400);
        if($newPassword !== $confirmNewPassword ) throw new Exception('A nova senha e a confirmação da nova senha não são iguais!, corrija e tente novamente. Caso o problema persista entre em contato com o suporte.', 400);
        $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->repository->updatePassword($id, $newPassword);
    }

    public function updatePasswordById(int $id, string $newPassword, string $confirmNewPassword)
    {
        if($newPassword !== $confirmNewPassword ) throw new Exception('A nova senha e a confirmação da nova senha não são iguais!, corrija e tente novamente. Caso o problema persista entre em contato com o suporte.', 400);
        $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->repository->updatePassword($id, $newPassword);
    }
}
