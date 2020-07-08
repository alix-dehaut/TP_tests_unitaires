<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\ToDoList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ToDoListFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new ToDoList();
        $user->setName('Liste des courses');
        $user->setUser($this->getReference(UserFixtures::ADMIN_USER_REFERENCE));

        $manager->persist($user);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

}