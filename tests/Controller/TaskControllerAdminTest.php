<?php

namespace App\Tests\Controller;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\assertEquals;

class TaskControllerAdminTest extends TaskControllerTest
{

    public function loadEntryPoints(): array
    {
        return [
            // ADMIN PART
            "testTaskListGetAdm" => [
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
                        "checkTaskNumber"
                    ]
                ]
            ],
            "testTaskCreateGetAdm" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/create",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskCreatePostAdmDataOK" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/create",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskCreatePostAdmDataKO" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/create",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_UNPROCESSABLE_ENTITY
                ]
            ],
            "testTaskEditGetAdmIdOk" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::ADMIN_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskEditGetAdmIdNotValid" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND
                ]
            ],
            "testTaskEditGetAdmIdNotBelong" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::ADMIN_BAD_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ],
            "testTaskEditGetAdmAnonymousTask" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::ANONYMOUS_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskEditPostAdmIdOkDataOk" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::ADMIN_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskEditPostAdmIdOkDataKo" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::ADMIN_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_UNPROCESSABLE_ENTITY
                ]
            ],
            "testTaskEditGetAdmIdNotValidDataOk" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND
                ]
            ],
            "testTaskEditGetAdmIdNotValidDataKo" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND
                ]
            ],
            "testTaskEditGetAdmIdNotBelongDataOk" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::USER_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ],
            "testTaskEditGetAdmIdNotBelongDataKo" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::USER_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ],
            "testTaskEditGetAdmAnonymousTaskDataOk" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::ANONYMOUS_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskEditGetAdmAnonymousTaskDataKo" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::ANONYMOUS_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_UNPROCESSABLE_ENTITY
                ]
            ],
            "testTaskTogglePutAdmIdOk" => [
                [
                    "type" => "PUT",
                    "url" => "/tasks/".self::ADMIN_TASK_ID."/toggle",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskTogglePutAdmIdNotValid" => [
                [
                    "type" => "PUT",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID."/toggle",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND
                ]
            ],
            "testTaskTogglePutAdmIdNotBelong" => [
                [
                    "type" => "PUT",
                    "url" => "/tasks/".self::USER_TASK_ID."/toggle",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ],
            "testTaskTogglePutAdmAnonymousTask" => [
                [
                    "type" => "PUT",
                    "url" => "/tasks/".self::ANONYMOUS_TASK_ID."/toggle",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskDeleteDeleteAdmIdOk" => [
                [
                    "type" => "DELETE",
                    "url" => "/tasks/".self::ADMIN_TASK_ID."/delete",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NO_CONTENT
                ]
            ],
            "testTaskDeleteDeleteAdmIdNotValid" => [
                [
                    "type" => "DELETE",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID."/delete",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND
                ]
            ],
            "testTaskDeleteDeleteAdmIdNotBelong" => [
                [
                    "type" => "DELETE",
                    "url" => "/tasks/".self::USER_TASK_ID."/delete",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ],
            "testTaskDeleteDeleteAdmAnonymousTask" => [
                [
                    "type" => "DELETE",
                    "url" => "/tasks/".self::ANONYMOUS_TASK_ID."/delete",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
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

    public function checkAnonymousTasksShow(Crawler $crawler)
    {

    }

    public function checkTaskNumber(Crawler $crawler)
    {
        assertEquals(self::ADMIN_TASKS + self::ANONYMOUS_TASKS, $crawler->filter('.task')->count());
    }
}
