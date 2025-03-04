<?php

namespace App\Events;
use App\Events\Event;
use App\Events\EventListener;

class EventBus {
    private $listeners = [];

    public function registerListener(string $eventName, EventListener $listener): void {
        if (!isset($this->listeners[$eventName])) {
            $this->listeners[$eventName] = [];
        }
        $this->listeners[$eventName][] = $listener;
    }

    public function dispatch(Event $event): void {
        $eventName = $event->getType();
        if (isset($this->listeners[$eventName])) {
            foreach ($this->listeners[$eventName] as $listener) {
                $listener->handle($event);
            }
        }
    }
}