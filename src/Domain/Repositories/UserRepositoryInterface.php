<?php

namespace Src\Domain\Repositories;

use Src\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function create(string $name, string $email, string $password, string $document, string $birthDate): void;
    public function update(int $id, string $name, string $email, string $document, string $birthDate): void;
    public function updatePassword(int $id, string $password): void;
    public function updateTokenById(int $id, string $token): void;
    public function findByEmail(string $email): User|null;
    public function findById(int $id): User|null;
    public function findByToken(string $token): User|null;
    public function deleteById(int $id): void;
}
