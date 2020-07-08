<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const ADMIN_USER_REFERENCE = 'user1';
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('user1@gmail.com');
        $user->setPassword('password');
        $user->setFirstname('Didier');
        $user->setLastname("Premier");
        $user->setAge(30);

        $manager->persist($user);
        $manager->flush();
        $this->addReference(self::ADMIN_USER_REFERENCE, $user);
    }

}