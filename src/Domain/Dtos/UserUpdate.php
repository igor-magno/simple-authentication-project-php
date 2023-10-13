<?php

namespace Src\Domain\Dtos;

use DateTime;

class UserUpdate
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $document,
        public DateTime $birthDate
    ) {}
}
