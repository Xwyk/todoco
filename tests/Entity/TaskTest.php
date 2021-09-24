<?php


namespace App\Tests\Entity;


use App\Entity\Task;
use App\Entity\User;
use App\Tests\MethodTestCase;
use App\Tests\XwykGetSetTestCase;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertEquals;

class TaskTest extends XwykGetSetTestCase
{

    private $createdAt;
    private $title;
    private $content;
    private $isDone;
    private $author;
    const CLASS_NAME = Task::class;
    public function loadSetters(){
        return[
            "testCreatedAtVariable"=>[
                [
                    "class" => self::CLASS_NAME,
                    "variable" => "createdAt",
                    "value" =>  new \DateTimeImmutable()
                ]
            ],
            "testTitleVariable"=>[
                [
                    "class" => self::CLASS_NAME,
                    "variable" => "title",
                    "value" => "test title"
                ]
            ],
            "testContentVariable"=>[
                [
                    "class" => self::CLASS_NAME,
                    "variable" => "content",
                    "value" => "test content"
                ]
            ],
            "testIsDoneVariable"=>[
                [
                    "class" => self::CLASS_NAME,
                    "variable" => "isDone",
                    "value" => true
                ]
            ],
            "testAuthorVariable"=>[
                [
                    "class" => self::CLASS_NAME,
                    "variable" => "author",
                    "value" => new User()
                ]
            ],
        ];
    }
    public function testToggleStateMethod(){
        $task = new Task();
        $task->setIsDone(false);
        $task->toggleState();
        assertEquals(true, $task->getIsDone());

    }
    public function testSetStateMethod(){
        $task = new Task();
        $task->setState();
        assertEquals(false, $task->getIsDone());
    }

    public function testSetDateMethod(){
        $task = new Task();
        $task->setDate();
        assertEquals("DateTimeImmutable", get_class($task->getCreatedAt()));
    }
}