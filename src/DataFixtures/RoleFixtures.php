<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Role;

class RoleFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $roleUser = ((new Role())->setName("ROLE_USER")
                                ->setDescription("Rôle utilisateur classique")
        );
        $roleAdmin = ((new Role())->setName("ROLE_ADMIN")
            ->setDescription("Rôle administrateur classique")
        );
        $this->addReference('ROLE_ADMIN', $roleAdmin);
        $this->addReference('ROLE_USER', $roleUser);
        $manager->persist($roleAdmin);
        $manager->persist($roleUser);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
