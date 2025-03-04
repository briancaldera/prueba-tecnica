<?php

namespace App\Events;

interface EventListener {
    public function handle(Event $event): void;
}
