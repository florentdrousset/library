<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use App\Form\NewBookFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    /**
     * @Route("/books", name="books")
     */
    public function index(BookRepository $book) {
        return $this->render('books/books.html.twig', [
            'books' => $book->findAll()
        ]);
    }

    /**
     * @Route("/book/{id}", name="book")
     */
    public function oneBook(Book $book) {
        return $this->render('books/book.html.twig', [
            'book' => $book
        ]);
    }

    /**
     * @Route("/books/new", name="book_new")
     */
    public function new(Request $request, \App\Services\ProcessingForm $processingForm)
    {
        $book = new Book();

        $form = $this->createForm(NewBookFormType::class, $book);

        $redirect = $processingForm->processForm($book, $form, $request); //la fonction renvoie true si le form est valid et submitted
        
        if ($redirect)
        {
            return $this->redirectToRoute('books');
        }
        
        return $this->render('books/newBook.html.twig', [
            'newBookForm' => $form->createView(),
        ]);

    }
}