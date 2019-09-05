<?php


namespace App\Events;

use App\Entity\Event;
use App\Entity\User;

class BookingEvent extends Event
{
    public const NAME = 'book.booking';

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}