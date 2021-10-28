<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use App\Tests\XwykGetSetTestCase;
use function PHPUnit\Framework\assertEquals;

class TaskTest extends XwykGetSetTestCase
{
    public const CLASS_NAME = Task::class;

    public function loadSetters()
    {
        return [
            'testCreatedAtVariable' => [
                [
                    'class' => self::CLASS_NAME,
                    'variable' => 'createdAt',
                    'value' => new \DateTimeImmutable(),
                ],
            ],
            'testTitleVariable' => [
                [
                    'class' => self::CLASS_NAME,
                    'variable' => 'title',
                    'value' => 'test title',
                ],
            ],
            'testContentVariable' => [
                [
                    'class' => self::CLASS_NAME,
                    'variable' => 'content',
                    'value' => 'test content',
                ],
            ],
            'testIsDoneVariable' => [
                [
                    'class' => self::CLASS_NAME,
                    'variable' => 'isDone',
                    'value' => true,
                ],
            ],
            'testAuthorVariable' => [
                [
                    'class' => self::CLASS_NAME,
                    'variable' => 'author',
                    'value' => new User(),
                ],
            ],
        ];
    }

    public function testToggleStateMethod()
    {
        $task = new Task();
        $task->setIsDone(false);
        $task->toggleState();
        assertEquals(true, $task->getIsDone());
    }

    public function testSetStateMethod()
    {
        $task = new Task();
        $task->setState();
        assertEquals(false, $task->getIsDone());
    }

    public function testSetDateMethod()
    {
        $task = new Task();
        $task->setDate();
        assertEquals('DateTimeImmutable', get_class($task->getCreatedAt()));
    }

    public function testSetCreatedAtMethod()
    {
        $task = new Task();
        $task->setCreatedAt();
        assertEquals('DateTimeImmutable', get_class($task->getCreatedAt()));
    }
}
