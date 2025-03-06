<?php

use App\Events\Listeners\SendEmailListener;
use App\Events\EventBus;

$emailListener = SendEmailListener::getInstance();

$eventBus = EventBus::getInstance();

$eventBus->registerListener('user-registered',$emailListener);
