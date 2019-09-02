<?php

namespace App\Events;

use Symfony\Contracts\EventDispatcher\Event;

class RegisterEvent extends Event
{
    const REGISTER = 'user.register';

}

?>