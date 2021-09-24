<?php

namespace App\Tests\Controller;
use App\Tests\XwykWebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertEquals;

class TaskControllerTest extends XwykWebTestCase
{
    const ADMIN_LOGIN = "admin1";
    const ADMIN_TASK_ID = 3;
    const ADMIN_BAD_TASK_ID = 2;
    const ADMIN_TASKS = 1;

    const USER_LOGIN = "user1";
    const USER_TASK_ID = 1;
    const USER_BAD_TASK_ID = 2;
    const USER_TASKS = 1;

    const DEFAULT_FAKE_TASK_ID = 100000;
    const ANONYMOUS_TASKS = 1;

    public function loadEntryPoints()
    {
        return [
            "testShowTasksNotLogged" => [
                [
                    "type" => "GET",
                    "url" => "/tasks",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => null,
                    "content" => "",
                    "expectedCode" => Response::HTTP_FOUND,
                    "additionalCheck" => [
                        "checkRedirectionShowTasksNotLogged"
                    ]
                ]
            ],
            "testShowTasksAsUser" => [
                [
                    "type" => "GET",
                    "url" => "/tasks",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK,
                    "additionalCheck" => [
                        "checkUserTasksShowTasksAsUser",
                        "checkAnonymousTasksShowTasksAsUser"
                    ]
                ]
            ],
            "testShowTasksAsAdmin" => [
                [
                    "type" => "GET",
                    "url" => "/tasks",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK,
                    "additionalCheck" => [
                        "checkAdminTasksShowTasksAsAdmin"
                    ]
                ]
            ],
            "testAddTasksNotLogged" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/create",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => null,
                    "content" => "",
                    "expectedCode" => Response::HTTP_FOUND,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testAddTasksAsUser" => [
                [
                    "type" => "POST",
                    "url" => "/tasks",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testAddTasksAsAdmin" => [
                [
                    "type" => "POST",
                    "url" => "/tasks",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testEditTaskNotLogged" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::USER_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => null,
                    "content" => "",
                    "expectedCode" => Response::HTTP_FOUND,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testEditTaskAsUserIdExistBelongUser" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::USER_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testEditTaskAsUserIdExistNotBelongUser" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::USER_BAD_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testEditTaskAsUserIdNotExist" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testEditTaskAsAdminIdExist" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::USER_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testEditTaskAsAdminIdNotExist" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ]
        ];
    }

    public function checkRedirectionShowTasksNotLogged(Crawler $crawler){
        $crawler
            ->filter('body')
            ->reduce(function ($node, $i) {
                assertEquals("Redirecting to /login.", $node->text());
            })
            ->first()
        ;
    }

    public function checkUserTasksShowTasksAsUser(Crawler $crawler)
    {
        assertEquals(self::USER_TASKS, $crawler->count(".task"));
//        $crawler
//            ->filter('.task')
//            ->reduce(function ($node, $i) {
//                dump($node);
//            })
//            ->first()
//        ;
    }

    public function checkAnonymousTasksShowTasksAsUser(Crawler $crawler)
    {

    }

    public function checkAdminTasksShowTasksAsAdmin(Crawler $crawler)
    {
        assertEquals(self::ADMIN_TASKS + self::ANONYMOUS_TASKS, $crawler->count(".task"));
//        $crawler
//            ->filter('.task')
//            ->reduce(function ($node, $i) {
//                dump($node);
//            })
//            ->first()
//        ;
    }
}
