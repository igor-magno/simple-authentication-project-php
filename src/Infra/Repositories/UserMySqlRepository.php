<?php

namespace Src\Infra\Repositories;

use DateTime;
use Src\Infra\Db\Connection;
use Src\Domain\Entities\User;
use Src\Domain\Repositories\UserRepositoryInterface;

class UserMySqlRepository implements UserRepositoryInterface
{
    public function create(string $name, string $email, string $password, string $document, string $birthDate): void
    {
        $connection = Connection::get();
        $state = $connection->prepare('INSERT INTO users (name, document, birth_date, email, password) VALUES (?, ?, ?, ?, ?);');
        $state->execute([$name, $document, $birthDate, $email, $password]);
    }

    public function update(int $id, string $name, string $email, string $document, string $birthDate): void
    {
        $connection = Connection::get();
        $state = $connection->prepare('UPDATE users SET name = ?, document = ?, birth_date = ?, email = ? WHERE id = ?;');
        $state->execute([$name, $document, $birthDate, $email, $id]);
    }

    public function findByEmail(string $email): User|null
    {
        $connection = Connection::get();
        $state = $connection->prepare('SELECT id,name, document, birth_date, email, password FROM users WHERE email = ? LIMIT 1;');
        $state->execute([$email]);
        $user = $state->fetch();
        if(!$user) return null;
        return new User($user->id, $user->name, $user->email, $user->document, $user->password, new DateTime($user->birth_date));
    }

    public function findById(int $id): User|null
    {
        $connection = Connection::get();
        $state = $connection->prepare('SELECT id,name, document, birth_date, email, password FROM users WHERE id = ? LIMIT 1;');
        $state->execute([$id]);
        $user = $state->fetch();
        return new User($user->id, $user->name, $user->email, $user->document, $user->password, new DateTime($user->birth_date));
    }

    public function deleteById(int $id): void
    {
        $connection = Connection::get();
        $state = $connection->prepare('DELETE FROM users WHERE id = ?;');
        $state->execute([$id]);
    }

    public function updateTokenById(int $id, string $token): void
    {
        $connection = Connection::get();
        $state = $connection->prepare('UPDATE users SET token = ? WHERE id = ?;');
        $state->execute([$token, $id]);
    }

    public function updatePassword(int $id, string $password): void
    {
        $connection = Connection::get();
        $state = $connection->prepare('UPDATE users SET password = ? WHERE id = ?;');
        $state->execute([$password, $id]);
    }

    public function findByToken(string $token): User|null
    {
        $connection = Connection::get();
        $state = $connection->prepare('SELECT id, name, document, birth_date, email, password FROM users WHERE token = ? LIMIT 1;');
        $state->execute([$token]);
        $user = $state->fetch();
        return new User($user->id, $user->name, $user->email, $user->document, $user->password, new DateTime($user->birth_date));
    }
}
