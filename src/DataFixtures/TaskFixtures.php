<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Class TaskFixtures
 * @package App\DataFixtures
 * @codeCoverageIgnore
 */
class TaskFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 100; $i++) {
            $manager->persist(
                $this->createTask(
                    $faker->sentence(6, true),
                    $faker->text(120),
                    $this->getReference("user1")
                )
            );
        }
        for ($i = 0; $i < 100; $i++) {
            $manager->persist(
                $this->createTask(
                    $faker->sentence(6, true),
                    $faker->text(120),
                    $this->getReference("user2")
                )
            );
        }
        for ($i = 0; $i < 100; $i++) {
            $manager->persist(
                $this->createTask(
                    $faker->sentence(6, true),
                    $faker->text(120),
                    $this->getReference("admin1")
                )
            );
        }
        for ($i = 0; $i < 100; $i++) {
            $manager->persist(
                $this->createTask(
                    $faker->sentence(6, true),
                    $faker->text(120),
                    $this->getReference("admin2")
                )
            );
        }
        for ($i = 0; $i < 100; $i++){
            $manager->persist(
                $this->createTask(
                    $faker->sentence(6, true),
                    $faker->text(120),
                )
            );
        }
        $manager->flush();
    }

    protected function createTask(string $title, string $content, User $author = null): Task{
        $task = new Task();
        $task->setTitle($title)
            ->setContent($content)
            ->setAuthor($author)
            ->setIsDone(false);
        return $task;
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
