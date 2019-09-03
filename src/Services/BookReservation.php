<?php


namespace App\Services;

use App\Entity\Booking;
use App\Services\updateStock;
use Doctrine\ORM\EntityManagerInterface;

class BookReservation
{
    private $sm;
    private $em;

    public function __construct(updateStock $sm, EntityManagerInterface $em) {
        $this->sm = $sm;
        $this->em = $em;
    }

    public function orderABook($book, $user) {
        $booking = new Booking();
        $booking->setUser($user);
        $this->em->persist($booking);
        $this->em->flush();
        $this->sm->decrementStock($book);
    }
}