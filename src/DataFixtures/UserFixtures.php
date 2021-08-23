<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $roleAdmin = $this->getReference('ROLE_ADMIN');
        $roleUser = $this->getReference('ROLE_USER');
        $user1 = ($this->createUser('user1', '$2y$10$zhyPqag22lVanuhFnMIuKum4CxGqibVIGtoYdltQMAC8P.irptOiq', "user1@todo.co"))->addRole($roleUser);
        $user2 = ($this->createUser('user2', '$2y$10$hm1avKE.F22E0vTKg8xP.u7hLLn9WcTzp86Zfi9Yxkrn2Jen1L81e', "user2@todo.co"))->addRole($roleUser);
        $admin1 = ($this->createUser('admin1', '$2y$10$TveeV/unhlMQpzP/va4EfOKr43WCvfuHgZqVCelo9Qz245bClBHfq', "admin1@todo.co"))->addRole($roleAdmin);
        $admin2 = ($this->createUser('admin2', '$2y$10$lP1MQ/PkQzgQU1hTRLQon.LJ/QjqOMfZjGsb2Opq1vTCVpr/JL6Ke', "admin2@todo.co"))->addRole($roleAdmin)
                                                                                                                                                          ->addRole($roleUser);
        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
        $this->addReference('admin1', $admin1);
        $this->addReference('admin2', $admin2);

        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($admin1);
        $manager->persist($admin2);
        $manager->flush();
    }

    protected function createUser(string $username, string $password, string $email): User{
        $user = new User();
        $user->setUsername($username)
             ->setPassword($password)
             ->setEmail($email);
        return $user;
    }

    public function getDependencies(): array
    {
        return [
            RoleFixtures::class,
        ];
    }

    public function getOrder()
    {
        return 2;
    }
}
