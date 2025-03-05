<?php

namespace App\Repositories;

use App\Models\User;
use App\ValueObjects\UserId;

interface UserRepositoryInterface {
    public function save(User $user): void;
    public function findById(UserId $id): ?User;
    public function delete(UserId $id): void;
}
