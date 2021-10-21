<?php

namespace App\Tests\Controller;

use App\Tests\XwykWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeControllerTest extends XwykWebTestCase
{
    public function loadEntryPoints()
    {
        return [
            // ADMIN PART
            'testHome' => [
                [
                    'type' => 'GET',
                    'url' => '/',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                ],
            ],
        ];
    }
}
