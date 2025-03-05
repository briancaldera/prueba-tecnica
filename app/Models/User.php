<?php

namespace App\Models;

use App\ValueObjects\UserId;
use App\ValueObjects\Name;
use App\ValueObjects\Email;
use App\ValueObjects\Password;

class User
{
    public function __construct(
        public private(set) Name $name,
        public private(set) Email $email,
        public private(set) Password $password,
        public private(set) \DateTimeImmutable $createdAt,
        public private(set) ?UserId $id = null,
    ) {

    }

    public function setId(UserId $id): void
    {
        $this->id = $id;
    }

    public function updateName(Name $name): void
    {
        $this->name = $name;
    }

    public function updateEmail(Email $email): void
    {
        if ($this->email == $email) return;

        $this->email = $email;
    }

    public function updatePassword(Password $password): void
    {
        $this->password = $password;
    }


}
