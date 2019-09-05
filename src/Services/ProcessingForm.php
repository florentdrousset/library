<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;

class ProcessingForm
{
    private $em;

    public function __construct(EntityManagerInterface $em) 
    {
        $this->em = $em;
    }

    public function processForm($object ,$form, $request)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $object = $form->getData();

            $this->em->persist($object);
            $this->em->flush();

            return true; // dans le controller: s'il y a une redirection à faire, il faut la mettre dans une condition
        }
    }

}

?>