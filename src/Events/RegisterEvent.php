<?php

namespace App\Events;

use App\Entity\User;

use Symfony\Contracts\EventDispatcher\Event;

class RegisterEvent extends Event
{
    const REGISTER = 'user.register';

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

