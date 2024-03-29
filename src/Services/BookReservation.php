<?php


namespace App\Services;

use App\Entity\Booking;
use App\Entity\User;
use App\Entity\Book;
use App\Events\BookingEvent;
use App\Services\updateStock;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class BookReservation
{
    private $sm;
    private $em;
    private $delete;

    public function __construct(updateStock $sm, EntityManagerInterface $em, \App\Services\DeleteObject $delete) {
        $this->sm = $sm;
        $this->em = $em;
        $this->delete = $delete;
    }

    /**
     * @param $book
     * @param $user
     * @throws \Exception
     */
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
        $dateOutInitial = $booking->getDateOut();
        $dateOutFinal = $dateOutInitial->add(new \DateInterval('P15D')); //le dateInterval ne passe pas dans la BDD => passage en string puis repassage en DateTime
        $toString = $dateOutFinal->format('Y-m-d H:i:s');
        $booking->setDateOut(new \DateTime($toString));

        $this->em->flush();

    }

    public function returnABook(Book $book, Booking $booking)
    {
        $this->sm->incrementStock($book);
        $this->delete->deleteBooking($booking);
    }
}