<?php

namespace App\Fixtures;

use App\Entity\User;
use App\Entity\Book;
use App\Entity\Event;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class DataFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // Création de 100 books
        for ($i = 0; $i < 30; $i++) {
            $book = new Book();

            $book->setTitle($faker->word);
            $book->setAuthor($faker->lastName);
            $book->setPublicationDate($faker->dateTimeBetween($startDate = '-50 years', $endDate = 'now', $timezone = null));
            $book->setGenre($faker->randomElement($array = array ('Roman','Poésie','Science-Fiction','Théâtre','Fable','Guerre','Histoire','Cuisine')));
            $book->setPitch($faker->text());
            $book->setQuantity($faker->numberBetween($min = 0, $max = 10));
            $manager->persist($book);
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

        // Création de 30 users
        for ($i = 0; $i < 30; $i++) {
            $user = new User();

            $user->setEmail($faker->email);
            $user->setRoles($faker->randomElements($array = array ('ROLE_SUPERADMIN','ROLE_ADMIN','ROLE_CLIENT'), $count = 1));
            $user->setPassword('password');
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setCity($faker->city());
            $user->setAddress($faker->address);
            $user->setZipCode($faker->postcode);
            $manager->persist($user);
        }

        $manager->flush();
    }

}

?>