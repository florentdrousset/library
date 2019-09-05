<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Booking;
use App\Entity\Book;

use App\Repository\UserRepository;
use App\Repository\BookRepository;
use App\Repository\BookingRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @Route("/admin/delete/{id}", name="admin_delete")
     */
    public function delete(User $user, \App\Services\DeleteObject $delete)
    {
        $delete->deleteUser($user);

        $this->addFlash(
            'delete',
            'Vous avez bien suprimé l\'utilisateur.'
        );

        return $this->redirectToRoute('admin');

    }

    /**
     * @Route("/admin/update/{id}", name="admin_update")
     */
    public function update(Request $request, User $user)
    {
        $value = $request->request->get('update_role');
        $user->setRoles([$value]);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        
        return $this->redirectToRoute('admin', ['post' => $_POST]);

    }
}

?>