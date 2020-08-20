<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use App\Entity\Book;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 25; $i++) {
            $book = new Book();

            $faker = Factory::create();
            $title = $faker->sentence($nbWords = 4, $variableNbWords = true);
            $author = $faker->name;
            $publisher = $faker->company;
            $year = (int)$faker->year($max = 'now');
            $description = $faker->text($maxNbChars = 200);
    
            $book->setTitle($title)
                ->setAuthor($author)
                ->setPublisher($publisher)
                ->setYear($year)
                ->setDescription($description);
    
            $manager->persist($book);    
        }
        
        $manager->flush();
    }
}
