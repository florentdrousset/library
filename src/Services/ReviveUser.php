<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Booking;

class ReviveUser
{
    private $em;
    private $sendMail;

    public function __construct(EntityManagerInterface $em, \App\Services\SendMail $sendMail)
    {
        $this->em = $em;
        $this->sendMail = $sendMail;
    }
    
    public function reviveThreeDaysBeforeDateOut()
    {  
        $bookings = $this->em->getRepository('App:Booking')->findAll();

        $now = new \DateTime('today');
        $interval = new \DateInterval('P3D');

        foreach ($bookings as $booking)
        {
            $dateOut = $booking->getDateOut();

            if ($now == $dateOut->sub($interval))
            {
                $this->sendMail->sendMailBeforeReturn($booking);
            }
        }
    }

}

?>