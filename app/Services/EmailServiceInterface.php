<?php

namespace App\Services;

use App\ValueObjects\Email;

interface EmailServiceInterface {
    public function emailExists(Email $email): bool;
}
