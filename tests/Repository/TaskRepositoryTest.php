<?php

namespace App\Tests\Repository;

use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertNotContains;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaskRepositoryTest extends KernelTestCase
{
    protected TaskRepository $taskRepository;
    protected UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->taskRepository = static::getContainer()->get(TaskRepository::class);
        $this->userRepository = static::getContainer()->get(UserRepository::class);
    }

    public function testFindByUser()
    {
        // Get test users
        $testUser = $this->userRepository->findOneByUsername('user1');
        $testAdmin = $this->userRepository->findOneByUsername('admin1');
        // Get tasks for each user from entity
        $userTasks = $testUser->getTasks();
        $adminTasks = $testAdmin->getTasks();
        // Get tasks for each user & null author tasks from repo
        $userTasksFromRepo = $this->taskRepository->findByUserState($testUser, false);
        $adminTasksFromRepo = $this->taskRepository->findByUserState($testAdmin, true);
        $nullTasks = $this->taskRepository->findByAuthor(null);

        // For user, test if each task is present from repo, and each null author isn't present
        foreach ($userTasks as $userTask) {
            assertContains($userTask, $userTasksFromRepo);
        }
        foreach ($nullTasks as $nullTask) {
            assertNotContains($nullTask, $userTasksFromRepo);
        }

        // For admin, test if each task is present from repo, and each null author is present
        foreach ($adminTasks as $adminTask) {
            assertContains($adminTask, $adminTasksFromRepo);
        }
        foreach ($nullTasks as $nullTask) {
            assertContains($nullTask, $adminTasksFromRepo);
        }
    }
}
