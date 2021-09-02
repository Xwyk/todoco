<?php

namespace App\Tests\Controller;
use App\Tests\TodoWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TaskControllerTest extends TodoWebTestCase
{
    const DEFAULT_REAL_TASK_ID = 1;
    const DEFAULT_BAD_TASK_ID = 2;
    const DEFAULT_FAKE_TASK_ID = 100;
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
                    "needReturnOnOK" => true,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
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
                    "needReturnOnOK" => false,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
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
                    "needReturnOnOK" => false,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            // "testAddTasksRequestNotLoggedDataOK" => [
            //     [
            //         "type" => "POST",
            //         "url" => "/tasks",
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => null,
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_UNAUTHORIZED,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testAddTasksRequestNotLoggedDataKO" => [
            //     [
            //         "type" => "GET",
            //         "url" => "/POST",
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => null,
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_UNAUTHORIZED,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testAddTasksRequestAsUserDataOK" => [
            //     [
            //         "type" => "POST",
            //         "url" => "/tasks",
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "USER",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_CREATED,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testAddTasksRequestAsUserDataKO" => [
            //     [
            //         "type" => "POST",
            //         "url" => "/tasks",
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "USER",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testAddTasksRequestAsAdminDataOK" => [
            //     [
            //         "type" => "POST",
            //         "url" => "/tasks",
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "ADMIN",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_CREATED,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testAddTasksRequestAsAdminDataKO" => [
            //     [
            //         "type" => "POST",
            //         "url" => "/tasks",
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "ADMIN",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
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
                    "needReturnOnOK" => false,
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
                    "needReturnOnOK" => false,
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
                    "needReturnOnOK" => false,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testGetTaskNotLogged" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_REAL_TASK_ID,
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => null,
                    "content" => "",
                    "expectedCode" => Response::HTTP_FOUND,
                    "needReturnOnOK" => false,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testGetTaskAsUserIdExistBelongUser" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_REAL_TASK_ID,
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK,
                    "needReturnOnOK" => false,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testGetTaskAsUserIdExistNotBelongUser" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_BAD_TASK_ID,
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN,
                    "needReturnOnOK" => false,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testGetTaskAsUserIdNotExist" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID,
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND,
                    "needReturnOnOK" => false,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testGetTaskAsAdminIdExist" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_REAL_TASK_ID,
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK,
                    "needReturnOnOK" => false,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testGetTaskAsAdminIdNotExist" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID,
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_NOT_FOUND,
                    "needReturnOnOK" => false,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testEditTaskNotLogged" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_REAL_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => null,
                    "content" => "",
                    "expectedCode" => Response::HTTP_FOUND,
                    "needReturnOnOK" => false,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testEditTaskAsUserIdExistBelongUser" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_REAL_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK,
                    "needReturnOnOK" => false,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testEditTaskAsUserIdExistNotBelongUser" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_BAD_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "USER",
                    "content" => "",
                    "expectedCode" => Response::HTTP_FORBIDDEN,
                    "needReturnOnOK" => false,
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
                    "needReturnOnOK" => false,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            "testEditTaskAsAdminIdExist" => [
                [
                    "type" => "GET",
                    "url" => "/tasks/".self::DEFAULT_REAL_TASK_ID."/edit",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => "ADMIN",
                    "content" => "",
                    "expectedCode" => Response::HTTP_OK,
                    "needReturnOnOK" => false,
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
                    "needReturnOnOK" => false,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ],
            // "testEditTaskRequestNotLogged" => [
            //     [
            //         "type" => "PUT",
            //         "url" => "/tasks/".self::DEFAULT_REAL_TASK_ID,
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => null,
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_FOUND,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testEditTaskRequestAsUserIdExistBelongUser" => [
            //     [
            //         "type" => "PUT",
            //         "url" => "/tasks/".self::DEFAULT_REAL_TASK_ID,
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "USER",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_OK,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testEditTaskRequestAsUserIdExistNotBelongUser" => [
            //     [
            //         "type" => "PUT",
            //         "url" => "/tasks/".self::DEFAULT_BAD_TASK_ID,
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "USER",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_FORBIDDEN,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testEditTaskRequestAsUserIdNotExist" => [
            //     [
            //         "type" => "PUT",
            //         "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID,
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "ADMIN",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_NOT_FOUND,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testEditTaskRequestAsAdminIdExist" => [
            //     [
            //         "type" => "PUT",
            //         "url" => "/tasks/".self::DEFAULT_REAL_TASK_ID,
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "ADMIN",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_OK,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testEditTaskRequestAsAdminIdNotExist" => [
            //     [
            //         "type" => "PUT",
            //         "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID,
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "ADMIN",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_NOT_FOUND,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testDeleteTaskRequestNotLogged" => [
            //     [
            //         "type" => "DELETE",
            //         "url" => "/tasks/".self::DEFAULT_REAL_TASK_ID,
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => null,
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_FOUND,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testDeleteTaskRequestAsUserIdExistBelongUser" => [
            //     [
            //         "type" => "DELETE",
            //         "url" => "/tasks/".self::DEFAULT_REAL_TASK_ID,
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "USER",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_OK,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testDeleteTaskRequestAsUserIdExistNotBelongUser" => [
            //     [
            //         "type" => "DELETE",
            //         "url" => "/tasks/".self::DEFAULT_BAD_TASK_ID,
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "USER",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_FORBIDDEN,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testDeleteTaskRequestAsUserIdNotExist" => [
            //     [
            //         "type" => "DELETE",
            //         "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID,
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "ADMIN",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_NOT_FOUND,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testDeleteTaskRequestAsAdminIdExist" => [
            //     [
            //         "type" => "DELETE",
            //         "url" => "/tasks/".self::DEFAULT_REAL_TASK_ID,
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "ADMIN",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_OK,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ],
            // "testDeleteTaskRequestAsAdminIdNotExist" => [
            //     [
            //         "type" => "DELETE",
            //         "url" => "/tasks/".self::DEFAULT_FAKE_TASK_ID,
            //         "parameters" => [],
            //         "files" => [],
            //         "server" => [],
            //         "authenticated" => "ADMIN",
            //         "content" => "",
            //         "expectedCode" => Response::HTTP_NOT_FOUND,
            //         "needReturnOnOK" => false,
            //         "additionalCheck" => "checkShowDetailsTokenOkIdOk"
            //     ]
            // ]
        ];
    }

    public function checkShowDetailsTokenOkIdOk($result){
//        dump(($result));
    }
}
