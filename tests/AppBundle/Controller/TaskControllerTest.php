<?php

namespace Tests\AppBundle\Controller;
use TestBundle\TodoWebTestCase;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends TodoWebTestCase
{
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
            "testShowTasksLoggedAsUser" => [
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
            "testShowTasksLoggedAsAdmin" => [
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
            ]
        ];
    }

    public function checkShowDetailsTokenOkIdOk($result){
        dump(($result));
    }
}
