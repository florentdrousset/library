<?php


namespace App\Controller;

use App\Services\BookReservation;
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
    public function reservation(Book $book, BookReservation $br, \App\Services\GetDateOutOfBooking $getDates) 
    {
        // $getDates->getDates()
        $user = $this->getUser();
        $br->orderABook($book, $user);
        return $this->render('books/book.html.twig', [
            'book' => $book
        ]);
    }

    public function bookReturner(Book $book, BookReservation $br) {

    }
}