<?php


namespace App\Events;

use Symfony\Contracts\EventDispatcher\Event;
use App\Entity\User;

class BookingEvent extends Event
{
    public const BOOKING = 'book.booking';

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