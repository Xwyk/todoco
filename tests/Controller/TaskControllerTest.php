<?php

namespace App\Tests\Controller;
use App\Tests\XwykWebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class TaskControllerTest extends XwykWebTestCase
{
    const ADMIN_LOGIN = "admin1";
    const ADMIN_TASK_ID = 3;
    const ADMIN_BAD_TASK_ID = 2;
    const ADMIN_TASKS = 100;

    const USER_LOGIN = "user1";
    const USER_TASK_ID = 1;
    const USER_BAD_TASK_ID = 200;
    const USER_TASKS = 100;

    const DEFAULT_FAKE_TASK_ID = 100000;
    const ANONYMOUS_TASKS = 100;

    public function loadEntryPoints(): array
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
                    "url" => "/tasks/create",
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
                    "url" => "/tasks/create",
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
                    "expectedCode" => Response::HTTP_FORBIDDEN
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
            ],
            "testToggleTaskAsUserIdOK" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::USER_TASK_ID."/toggle",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testDeleteTaskAsUserIdOK" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::USER_TASK_ID."/delete",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NO_CONTENT
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
        // Check tasks number
        assertEquals(self::USER_TASKS, $crawler->filter('.task')->count());
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
        assertEquals(self::ADMIN_TASKS + self::ANONYMOUS_TASKS, $crawler->filter('.task')->count());
//        $crawler
//            ->filter('.task')
//            ->reduce(function ($node, $i) {
//                dump($node);
//            })
//            ->first()
//        ;
    }
}
