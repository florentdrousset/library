<?php

namespace App\Events;

use App\Entity\User;
use App\Entity\Book;

use Symfony\Contracts\EventDispatcher\Event;

class BookingEvent extends Event
{
    const BOOKING = 'user.booking';

}

?>