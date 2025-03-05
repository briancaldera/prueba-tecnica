<?php

namespace App\Events;

use App\Events\Event;
use App\Models\User;

class UserRegisteredEvent implements Event
{
    protected string $type = 'user-registered';
    public function getType(): string
    {
        return $this->type;
    }

    public function __construct(public protected(set) User $user)
    {
    }
}
