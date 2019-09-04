<?php

namespace App\Services;

use App\Entity\User;
use App\Entity\Booking;
use App\Entity\Book;

use Doctrine\ORM\EntityManagerInterface;

class DeleteObject
{
    private $em;

    public function __construct(updateStock $sm, EntityManagerInterface $em) 
    {
        $this->em = $em;
    }

    public function deleteUser(User $user)
    {
        $bookings = $this->em->getRepository('App:Booking')->findBy(['user' => $user->getId()]); //récupère toutes les réservations d'un user

        $this->deleteBooking($bookings);
        
        $this->em->remove($user);
        $this->em->flush();
    }

    public function deleteBooking($bookings)
    {
        if (is_array($bookings))
        {
            if (!empty($bookings))
            {
                foreach ($bookings as $booking)
                {
                    $this->em->remove($booking);
                }
            }
        }
        else
        {
            $this->em->remove($bookings);
        }

        $this->em->flush();
    }

}

?>