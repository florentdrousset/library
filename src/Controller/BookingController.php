<?php


namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use App\Repository\BookingRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\updateStock;
use App\Entity\Booking;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class BookingController extends AbstractController

{
    /**
     * @Route("/reservation/{id}", name="reservation")
     */
    public function reservation(updateStock $us, Book $book, Session $session, BookRepository $bookrep, EntityManagerInterface $em, BookingRepository $bookingrep, \App\Services\GetDateOutOfBooking $GetDates) 
    {
        $GetDates->getDates($bookingrep);
        
        $booking = new Booking();
        $booking->setUser($this->getUser());
        $em->persist($booking);
        $em->flush();
        $us->decrementStock($book);
        return $this->render('books/book.html.twig', [
            'book' => $book
        ]);
    }
}