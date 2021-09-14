<?php


namespace App\Manager;


use App\Entity\User;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use \Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager extends EntityManager
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher, Connection $conn, Configuration $config, EventManager $eventManager)
    {
        $this->passwordHasher=$passwordHasher;
        parent::__construct($conn, $config, $eventManager);
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