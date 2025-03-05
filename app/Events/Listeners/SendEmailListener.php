<?php

namespace App\Events\Listeners;

use App\Events\EventListener;
use App\Events\Event;

class SendEmailListener implements EventListener
{
    public function handle(Event $event): void
    {

        switch ($event->getType()) {
            case 'user-registered':

                $user = $event['user'];
                echo 'Usuario registrado:';
                // Enviar email al usuario...
                break;

            default:

                break;
        }
    }
}