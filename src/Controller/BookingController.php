<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Booking;
use App\Entity\User;
use App\Events\BookingEvent;
use App\Services\BookReservation;


use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingController extends AbstractController

{
    /**
     * @Route("/reservation/{id}", name="reservation")
     */
    public function reservation(Book $book, BookReservation $br, Request $request, EventDispatcherInterface $dispatcher)
    {
        $user = $this->getUser();
        $event = new BookingEvent($user);
        $dispatcher->dispatch($event, BookingEvent::BOOKING);

        $user = $this->getUser();
        $id = $request->get('id');
        try {
            $this->denyAccessUnlessGranted('book', $book);
        } catch(\Exception $e) {
            $this->addFlash('noBook', 'Erreur : vous ne pouvez pas emprunter plus de 5 livres en même temps !');
            $this->redirectToRoute('book', array(
                'id' => $id
            ));
        }
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

        $this->addFlash(
            'revive',
            'Les relances ont été effectuées.'
        );

        return $this->redirectToRoute('home');
    }

}