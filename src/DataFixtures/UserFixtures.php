<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const USERS = [
        [
            'email' => 'g.hartemann@gmail.com',
            'roles' => ['ROLE_ADMIN'],
            'password' => 'password',
        ],
        [
            'email' => 'aurianephd@gmail.com',
            'roles' => ['ROLE_USER'],
            'password' => 'password',
        ],];

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::USERS as $inputUser) {
            $user = new User();

            $password = $this->passwordHasher->hashPassword($user, $inputUser['password']);

            $user
                ->setEmail($inputUser['email'])
                ->setRoles($inputUser['roles'])
                ->setPassword($password);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
