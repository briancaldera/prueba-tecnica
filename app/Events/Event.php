<?php

namespace App\Events;

interface Event {
    public function getType(): string;
}
