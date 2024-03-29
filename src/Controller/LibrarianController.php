<?php


namespace App\Controller;

use App\Entity\Booking;
use App\Repository\UserRepository;
use App\Services\BookReservation;
use App\Entity\Book;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class LibrarianController extends AbstractController
{
    /**
     * @Route("/librarian", name="librarian")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function index(UserRepository $ur) {
        $allUsers = $ur->findAll();

        return $this->render(
            'admin/librarian.html.twig',
            [
                'user' => $this->getUser(),
                'users' => $allUsers
            ]
        );
    }
    /**
     * @Route("/searchUser", name="searchUser")
     */
    public function searchUser(Request $request, UserRepository $ur) {
        $firstName = $request->request->get('firstName');
        $lastName = $request->request->get('lastName');

        $result = $ur->findBy(array('firstName' => $firstName, 'lastName' => $lastName));
        //findOneBy
        if($result) {
        return $this->render(
            'admin/bookReturn.html.twig',
            [
                'user' => $result
            ]
        );
        } else {
            $this->addFlash('error', 'Cet utilisateur n\'existe pas');
            return $this->render(
                'admin/librarian.html.twig',
                [
                    'user' => $this->getUser(),
                    'users' => $ur->findAll(),
                ]
            );
        }
    }

    /**
     * @Route("/bookreturn/{id}", name="bookreturn")
     */
    public function returnABook(Booking $booking, Request $request, BookReservation $br, UserRepository $ur)
    {
        $firstName = $request->request->get('firstName');
        $lastName = $request->request->get('lastName');
        $user = $ur->findBy(array('firstName' => $firstName, 'lastName' => $lastName));
        $book = $booking->getBook();
        $br->returnABook($book, $booking);

    return $this->render(
        'admin/bookReturn.html.twig',
            [
                'user' => $user
            ]
        );
    }

    /**
     * @Route("autocomplete/{query}", name="autocomplete", methods={"GET"})
     */
    public function autocompletionSearch(UserRepository $ur, Request $request) {
        $result = $ur->findByExampleField($request->query->get('search'));
        return new JsonResponse($result);
    }
}