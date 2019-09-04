<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user-space", name="userSpace")
     */
    public function showUserSpace() {
        $user = $this->getUser();
        return $this->render('user/userspace.html.twig', [
            'user' => $user
        ]);
    }
}