<?php

namespace Src\Domain\Dtos;

use DateTime;

class UserCreate
{
    public function __construct(
        public string $name,
        public string $email,
        public string $document,
        public string $password,
        public DateTime $birthDate
    ) {}
}
