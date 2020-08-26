<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;
use Faker\Generator;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 25; $i++) {
            $user = new User();
            $faker = Factory::create();
            $email = $faker->email;
            $password = 'password';
            if (substr($email, 0, 1) === 'e') {
                $role = ['ROLE_ADMIN'];
            } else {
                $role = [];
            }

            $user->setEmail($email)->setRoles($role)->setPassword($this->passwordEncoder->encodePassword($user, $password));

            $manager->persist($user);
        }
        
        $manager->flush();
    }
}
