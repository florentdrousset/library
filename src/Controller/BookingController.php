<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Booking;
use App\Services\BookReservation;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\updateStock;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class BookingController extends AbstractController

{
    /**
     * @Route("/reservation/{id}", name="reservation")
     */
    public function reservation(Book $book, BookReservation $br) 
    {
        $user = $this->getUser();
        $br->orderABook($book, $user);
        return $this->render('books/book.html.twig', [
            'book' => $book
        ]);
    }

    /**
     * @Route("/prolongation/{id}", name="prolongation")
     */
    public function prolongation(Booking $booking, BookReservation $br) 
    {
        $user = $this->getUser();
        $br->prolongateABook($booking);
// dd($booking);
        $this->addFlash(
            'revive',
            'Les relances ont été effectuées.'
        );
        
        // $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('home');
    }

}