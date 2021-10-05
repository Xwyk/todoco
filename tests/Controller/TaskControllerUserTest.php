<?php

namespace App\Tests\Controller;

use App\Tests\XwykWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TaskControllerUserTest extends XwykWebTestCase
{

    const USER_LOGIN = "user1";
    const USER_TASK_ID = 1;
    const USER_BAD_TASK_ID = 200;
    const USER_TASKS = 100;

    const DEFAULT_FAKE_TASK_ID = 100000;
    const ANONYMOUS_TASKS = 100;
    const ANONYMOUS_TASK_ID = 452;

    public function loadEntryPoints(): array
    {
        return [
            "testTaskListGetUsr" => [
                [
                    "type" => "GET",
                    "url" => "/tasks",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskCreateGetUsr" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/create",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskCreatePostUsrDataOK" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/create",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskCreatePostUsrDataKO" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/create",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_UNPROCESSABLE_ENTITY
                ]
            ],
            "testTaskEditGetUsrIdOk" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::USER_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskEditGetUsrIdNotValid" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND
                ]
            ],
            "testTaskEditGetUsrIdNotBelong" => [
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
            "testTaskEditGetUsrAnonymousTask" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::ANONYMOUS_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ],
            "testTaskEditPostUsrIdOkDataOk" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::USER_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskEditPostUsrIdOkDataKo" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::USER_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_UNPROCESSABLE_ENTITY
                ]
            ],
            "testTaskEditGetUsrIdNotValidDataOk" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND
                ]
            ],
            "testTaskEditGetUsrIdNotValidDataKo" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND
                ]
            ],
            "testTaskEditGetUsrIdNotBelongDataOk" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::USER_BAD_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ],
            "testTaskEditGetUsrIdNotBelongDataKo" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::USER_BAD_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ],
            "testTaskEditGetUsrAnonymousTaskDataOk" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::ANONYMOUS_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ],
            "testTaskEditGetUsrAnonymousTaskDataKo" => [
                [
                    "type" => "POST",
                    "url" => "/tasks/".self::ANONYMOUS_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ],
            "testTaskTogglePutUsrIdOk" => [
                [
                    "type" => "PUT",
                    "url" => "/tasks/".self::USER_TASK_ID."/toggle",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK
                ]
            ],
            "testTaskTogglePutUsrIdNotValid" => [
                [
                    "type" => "PUT",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID."/toggle",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND
                ]
            ],
            "testTaskTogglePutUsrIdNotBelong" => [
                [
                    "type" => "PUT",
                    "url" => "/tasks/".self::USER_BAD_TASK_ID."/toggle",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ],
            "testTaskTogglePutUsrAnonymousTask" => [
                [
                    "type" => "PUT",
                    "url" => "/tasks/".self::ANONYMOUS_TASK_ID."/toggle",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ],
            "testTaskDeleteDeleteUsrIdOk" => [
                [
                    "type" => "DELETE",
                    "url" => "/tasks/".self::USER_TASK_ID."/delete",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NO_CONTENT
                ]
            ],
            "testTaskDeleteDeleteUsrIdNotValid" => [
                [
                    "type" => "DELETE",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID."/delete",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND
                ]
            ],
            "testTaskDeleteDeleteUsrIdNotBelong" => [
                [
                    "type" => "DELETE",
                    "url" => "/tasks/".self::USER_BAD_TASK_ID."/delete",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ],
            "testTaskDeleteDeleteUsrAnonymousTask" => [
                [
                    "type" => "DELETE",
                    "url" => "/tasks/".self::ANONYMOUS_TASK_ID."/delete",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN
                ]
            ]
        ];
    }
}