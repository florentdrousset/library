<?php


namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;

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
}