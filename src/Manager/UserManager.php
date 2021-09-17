<?php


namespace App\Manager;


use App\Entity\User;
use Doctrine\ORM\EntityManager;
use \Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher=$passwordHasher;
    }

    public function setPassword(User $user, string $plainPassword){
        $user->setPassword(
            $this->passwordHasher->hashPassword(
                $user,
                $plainPassword
            )
        );
    }
}