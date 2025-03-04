<?php

namespace App\Events;

use App\Events\Event;

class UserRegisteredEvent implements Event
{
    protected string $type = 'user-registered';
    public function getType(): string
    {
        return $this->type;
    }
}
