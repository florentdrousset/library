<?php

namespace App\Services;

use App\Entity\Book;

use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class updateStock
{
    private $em;
    private $session;

    public function __construct(EntityManagerInterface $em, SessionInterface $session)
    {
        $this->em = $em;
        $this->session = $session;
    }
    public function incrementStock(Book $book)
    {
        $book->setQuantity($book->getQuantity()+1);
        $this->session->getFlashBag()->add('returnedBook', 'Le livre a été rendu.');
    }

    public function decrementStock(Book $book)
    {
        if ($book->getQuantity() > 0)
        {

            $book->setQuantity($book->getQuantity()-1);
            $this->session->getFlashBag()->add('returnedBook', 'Ce livre a bien été emprunté !');
            $this->em->persist($book);
            $this->em->flush();
            return true;
        }
        else
        {
            $this->session->getFlashBag()->add('noBook', 'Ce livre n\'est plus disponible.');
            return false;
        }
    }

}
