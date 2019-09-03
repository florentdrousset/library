<?php

namespace App\Services;

use Doctrine\ORM\EntityManager;

class GetDateOutOfBooking
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getDates()
    {
        $dates = $this->em->getRepository('BookingRepository')->findAll();

        dd($dates);
    }

}

?>