<?php

namespace App\Fixtures;

use App\Entity\User;
use App\Entity\Book;
use App\Entity\Booking;
use App\Entity\Event;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class DataFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $users = [];
        $books = [];
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // Création de 30 users
        for ($i = 0; $i < 30; $i++) {
            $user = new User();

            $user->setEmail($faker->email);
            $user->setRoles($faker->randomElements($array = array ('ROLE_SUPERADMIN','ROLE_ADMIN','ROLE_CLIENT'), $count = 1));
            $user->setPassword($this->encoder->encodePassword($user, 'password'));
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setCity($faker->city());
            $user->setAddress($faker->address);
            $user->setZipCode($faker->postcode);
            $manager->persist($user);

            $users[] = $user;
        }
        // Création de 100 books
        for ($i = 0; $i < 100; $i++) {
            $book = new Book();

            $book->setTitle($faker->word);
            $book->setAuthor($faker->lastName);
            $book->setPublicationDate($faker->dateTimeBetween($startDate = '-50 years', $endDate = 'now', $timezone = null));
            $book->setGenre($faker->randomElement($array = array ('Roman','Poésie','Science-Fiction','Théâtre','Fable','Guerre','Histoire','Cuisine')));
            $book->setPitch($faker->text());
            $book->setQuantity($faker->numberBetween($min = 0, $max = 10));
            $manager->persist($book);

            $books[] = $book;
        }
        
        // Création de 30 events
        for ($i = 0; $i < 30; $i++) {
            $event = new Event();

            $start = new \DateTime();
            $date = new \DateTime('today');
            $end = $date->add(new \DateInterval('P10M'));        

            $randomTimestamp = mt_rand($start->getTimestamp(), $end->getTimestamp());

            $startEvent = new \DateTime();
            $startEvent->setTimestamp($randomTimestamp);

            $endEvent = new \DateTime();
            $endEvent->setTimestamp($randomTimestamp)->add(new \DateInterval('P5D'));

            $event->setName($faker->word);
            $event->setStartDate($startEvent);
            $event->setEndDate($endEvent);
            $event->setDescription($faker->text());
            $event->setLocation($faker->address());
            $event->setCity($faker->city());
            $manager->persist($event);
        }

        // Création de 30 bookings
        for ($i = 0; $i < 30; $i++) {
            
            $bookChosen = $books[rand(0, count($books)-1)];

            $booking = new Booking();

            $booking->setUser($users[rand(0, count($users)-1)]);
            $booking->setDateIn($faker->dateTimeBetween($startDate = '-20 days', $endDate = 'now', $timezone = null));
            $booking->setDateOut($faker->dateTimeBetween($startDate = 'now', $endDate = '+15 days', $timezone = null));
            $booking->setBook($bookChosen);
            $manager->persist($booking);
        }

        $manager->flush();
    }

}

