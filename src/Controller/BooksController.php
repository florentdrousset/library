<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use App\Form\NewBookFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    /**
     * @param BookRepository $br
     * @Route("/books", name="books")
     * @return Response
     */
    public function index(BookRepository $br) {

        return $this->render('books/books.html.twig', [
            'books' => $br->findAll(),
            'genres' => $br->getAllGenres()
        ]);
    }

    /**
     * @param BookRepository $br, Request $request
     * @param Request $request
     * @Route("/booksByGenre", name="booksByGenre")
     * @return Response
     */
    public function booksByGenre(BookRepository $br, Request $request) {
       $genre = $request->get('genre');
        $booksByGenre = $br->findBy(array(
            'genre' => $genre
        ));
       return $this->render('books/books.html.twig', [
           'books' => $booksByGenre,
           'genres' => $br->getAllGenres()
        ]);
    }

    /**
     * @param Book $book
     * @Route("/book/{id}", name="book")
     * @return Response
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