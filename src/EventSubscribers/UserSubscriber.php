<?php

namespace App\EventSubscribers;

use App\Events\RegisterEvent;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            RegisterEvent::REGISTER => ['mailingRegister', 10],
        ];
    }

    public function mailingRegister()
    {

    }

}

