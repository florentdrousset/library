<?php

namespace App\EventSubscribers;

use App\Events\RegisterEvent;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface
{
    private $sendMail;

    public function __construct(\App\Services\SendMail $sendMail)
    {
        $this->sendMail = $sendMail;
    }

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            RegisterEvent::REGISTER => ['mailingRegister', 10],
        ];
    }

    public function mailingRegister(RegisterEvent $event)
    {
        $this->sendMail->sendMailAfterRegistration($event->getUser());
    }

}

