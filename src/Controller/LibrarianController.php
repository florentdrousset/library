<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class LibrarianController extends AbstractController
{
    /**
     * @Route("/librarian", name="librarian")
     */
    public function index(UserRepository $ur) {
        return $this->render(
            'admin/librarian.html.twig',
            [
                'user' => $this->getUser()
            ]
        );
    }
}