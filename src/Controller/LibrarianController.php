<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
        $firstName = $request->request->get('firstName');
        $lastName = $request->request->get('lastName');
        $result = $ur->findBy(array('firstName' => $firstName, 'lastName' => $lastName));
        if($result) {
        return $this->render(
            'admin/bookReturn.html.twig',
            [
                'user' => $result,
            ]
        );
        } else {
            $this->addFlash('error', 'Cet utilisateur n\'existe pas');
            return $this->render(
                'admin/librarian.html.twig',
                [
                    'user' => $this->getUser(),
                    'users' => $ur->findAll()
                ]
            );
        }
    }
}