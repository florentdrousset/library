<?php

namespace App\EventSubscribers;

use App\Events\BookingEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BookingSubscriber implements EventSubscriberInterface
{
    private $sendMail;

    public function __construct(\App\Services\SendMail $sendMail)
    {
        $this->sendMail = $sendMail;
    }
    public static function getSubscribedEvents()
    {
        return [
            BookingEvent::BOOKING => [
                'sendMailOnBooking', 10
            ]
        ];
    }

    public function sendMailOnBooking(BookingEvent $event) {
        $this->sendMail->sendMailAfterBooking($event->getUser());
    }
}