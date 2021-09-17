<?php


namespace App\Tests\Entity;


use App\Entity\Task;
use App\Entity\User;
use App\Tests\MethodTestCase;
use App\Tests\XwykGetSetTestCase;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertEquals;

class UserTest extends XwykGetSetTestCase
{
    const CLASS_NAME = User::class;
    public function loadSetters(){
        return[
            "testUsernameVariable"=>[
                [
                    "class" => self::CLASS_NAME,
                    "variable" => "username",
                    "value" => "toto"
                ]
            ],
            "testPasswordVariable"=>[
                [
                    "class" => self::CLASS_NAME,
                    "variable" => "password",
                    "value" => "totopassword"
                ]
            ],
            "testEmailVariable"=>[
                [
                    "class" => self::CLASS_NAME,
                    "variable" => "email",
                    "value" => "test@todoco.fr"
                ]
            ],
            "testRoleVariable"=>[
                [
                    "class" => self::CLASS_NAME,
                    "variable" => "role",
                    "value" => "ROLE_ADMIN"
                ]
            ],
        ];
    }
    public function testTaskVariable(){
        $task = new Task();
        $user = new User();
        $user->addTask($task);
        assertContains($task, $user->getTasks());
    }
}