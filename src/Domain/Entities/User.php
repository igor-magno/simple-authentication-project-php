<?php

namespace Src\Domain\Entities;

use DateTime;

class User
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $document,
        public string $password,
        public DateTime $birthDate
    ) {
    }
}
