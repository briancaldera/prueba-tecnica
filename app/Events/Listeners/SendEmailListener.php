<?php

namespace App\Events\Listeners;

use App\Events\EventListener;
use App\Events\Event;
use App\Events\UserRegisteredEvent;

class SendEmailListener implements EventListener
{
    private static ?SendEmailListener $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function handle(Event $event): void
    {
        switch ($event->getType()) {
            case 'user-registered':
                if ($event instanceof UserRegisteredEvent) {
                    $user = $event->user;
                    print("\n");
                    print('Usuario registrado ' . "[ID]: " . $user->id . ' | Correo enviado');
                    print("\n");
                }
                // Enviar email al usuario...
                break;

            default:
                break;
        }
    }
}