<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;

use App\Repository\BookingRepository;

class GetDateOutOfBooking
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    public function getDates()
    {
        $bookings = $this->em->getRepository('BookingRepository')->findAll();

        $now = new \DateTime('today');
        $interval = new \DateInterval('P3D');

        foreach ($bookings as $booking)
        {
            $dateOut = $booking->getDateOut();

            if ($now == $dateOut->sub($interval))
            {
                var_dump($booking);
            }
        }
        die;
    }

}

?>