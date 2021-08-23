<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TaskFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $task1 = $this->createTask('Task 1', 'Description 1', $this->getReference('user1'));
        $task2 = $this->createTask('Task 2', 'Description 2', $this->getReference('user2'));
        $task3 = $this->createTask('Task 3', 'Description 3', $this->getReference('admin1'));
        $task4 = $this->createTask('Task 4', 'Description 4', $this->getReference('admin2'));
        $manager->persist($task1);
        $manager->persist($task2);
        $manager->persist($task3);
        $manager->persist($task4);
        $manager->flush();
    }

    protected function createTask(string $title, string $content, User $author): Task{
        $user = new Task();
        $user->setTitle($title)
            ->setContent($content)
            ->setAuthor($author)
            ->setIsDone(false);
        return $user;
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }

    public function getOrder()
    {
        return 3;
    }
}
