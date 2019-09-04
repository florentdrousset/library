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
        $now = new \DateTime();
        $in15days = new \DateTime();
        $in15days->add(new \DateInterval('P15D'));
        $booking = new Booking();
        //TODO: checker si l'utilisateur est bien connecté
        $booking->setUser($user);
        $booking->setBook($book);
        $booking->setDateIn($now);
        $booking->setDateOut($in15days);
        $this->em->persist($booking);
        $this->em->flush();

        $this->sm->decrementStock($book);
    }

    public function prolongateABook(Booking $booking)
    {
        // $dateOutInitial = $booking->getDateOut();
        // dd($booking->getBook()->getGenre());
        dd($booking->getDateOut());
        // $dateOutFinal = $dateOutInitial->add(new \DateInterval('P15D'));
        // $booking->setDateOut($dateOutFinal);
        $booking->prolongate();
        $booking->setDateOut(new \DateTime('2020-05-25'));
        // $this->em->persist($booking);
        $this->em->flush();

        // dd($booking);
    }

    public function returnABook() {

    }
}