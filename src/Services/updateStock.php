<?php

namespace App\Services;

use App\Entity\Book;

use Symfony\Component\HttpFoundation\Session\Session;

class updateStock
{

    public function incrementStock(Book $book)
    {
        
        $book->setQuantity($book->getQuantity()+1);
        $session->getFlashBag()->add('returnedBook', 'Le livre a été rendu.');
            
    }

    public function decrementStock(Book $book)
    {
        if ($book->getQuantity() > 0)
        {
            $book->setQuantity($book->getQuantity()-1);
            return true;
        }
        else
        {
            $session->getFlashBag()->add('noBook', 'Ce livre n\'est plus disponible.');
            return false;
        }
    }

}

?>