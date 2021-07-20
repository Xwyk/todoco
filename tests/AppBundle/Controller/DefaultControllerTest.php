<?php

namespace Tests\AppBundle\Controller;
use TestBundle\TodoWebTestCase;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends TodoWebTestCase
{
    public function loadEntryPoints()
    {
        return [
            "testShowHomeNotLogged" => [
                [
                    "type" => "GET",
                    "url" => "/",
                    "parameters" => [],
                    "files" => [],
                    "server" => [],
                    "authenticated" => false,
                    "content" => "",
                    "expectedCode" => Response::HTTP_FOUND,
                    "needReturnOnOK" => true,
                    "additionalCheck" => "checkShowDetailsTokenOkIdOk"
                ]
            ]
        ];
    }

    public function checkShowDetailsTokenOkIdOk($result){
        dump(($result));
    }
}
