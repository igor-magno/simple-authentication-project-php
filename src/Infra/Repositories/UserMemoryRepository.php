<?php

namespace Src\Infra\Repositories;

use Src\Domain\Entities\User;
use Src\Domain\Repositories\UserRepositoryInterface;

class UserMemoryRepository implements UserRepositoryInterface
{
    private $users;

    public function __construct()
    {
        $this->users = [];
    }

    public function create(string $email, string $password): void
    {
        $this->users[] = (object)[
            'id' => count($this->users) + 1,
            'email' => $email,
            'password' => $password
        ];
    }

    public function findByEmail(string $email): User|null
    {
        $user = null;
        for ($i = 0; $i < count($this->users); $i++) {
            $currentUser = $this->users[$i];
            if($currentUser->email === $email) return new User($currentUser->id, $currentUser->email, $currentUser->password); 
        }
        return $user;
    }

    public function findById(int $id): User|null
    {
        $user = null;
        for ($i = 0; $i < count($this->users); $i++) {
            $currentUser = $this->users[$i];
            if($currentUser->id === $id) return new User($currentUser->id, $currentUser->email, $currentUser->password); 
        }
        return $user;
    }

    public function deleteById(int $id): void
    {
        $users = [];
        for ($i = 0; $i < count($this->users); $i++) {
            $currentUser = $this->users[$i];
            if($currentUser->id !== $id) 
                $users[] = $currentUser; 
        }
        $this->users = $users;
    }
}
