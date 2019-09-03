<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\updateStock;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ReviveController extends AbstractController
{
    /**
     * @Route("/revive", name="revive")
     */
    public function revive(\App\Services\ReviveUser $revive) 
    {
        $revive->reviveThreeDaysBeforeDateOut();
        
        return $this->redirectToRoute('librarian');
    }

}

?>