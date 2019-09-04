<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\BookRepository;
use App\Repository\BookingRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="admin")
     */
    public function index(UserRepository $users, BookRepository $books, BookingRepository $bookings)
    {
        return $this->render('admin/admin.html.twig', [
                'users' => $users->findAll(),
                'books' => $books->findAll(),
                'bookings' => $bookings->findAll(),
            ]
        );
    }
}

?>