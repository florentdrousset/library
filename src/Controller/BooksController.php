<?php


namespace App\Controller;
use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}