<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(private EntityManagerInterface $entityManager, private UserPasswordHasherInterface $userPasswordHasher){}

    public function save(User $user, String $pass): void
    {
        // encode the plain password
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $pass));

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function update(User $user): void
    {
        $this->entityManager->flush();
    }

    public function getPicturePath(): String
    {
        return 'uploads/default-user-pic.svg';
    }
}
