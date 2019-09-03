<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class LibrarianController extends AbstractController
{
    /**
     * @Route("/librarian", name="librarian")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function index(UserRepository $ur) {
        return $this->render(
            'admin/librarian.html.twig',
            [
                'user' => $this->getUser(),
                'users' => $ur->findAll()
            ]
        );
    }
    /**
     * @Route("/searchUser", name="searchUser")
     */
    public function searchUser(Request $request, UserRepository $ur) {
        $result = $request->request->all();
        $ur->findBy();
    }
}