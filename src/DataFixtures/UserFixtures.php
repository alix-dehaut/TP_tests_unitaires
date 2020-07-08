<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\TokenSerivce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const ADMIN_USER_REFERENCE = 'user1';
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('user1@gmail.com');
        $user->setPassword('password');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'password'
        ));
        $user->setFirstname('Didier');
        $user->setLastname("Premier");
        $user->setAge(30);

        $manager->persist($user);
        $manager->flush();
        $this->addReference(self::ADMIN_USER_REFERENCE, $user);
    }

}