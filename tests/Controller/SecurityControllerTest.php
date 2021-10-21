<?php

namespace App\Tests\Controller;

use App\Tests\XwykWebTestCase;
use function PHPUnit\Framework\assertEquals;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends XwykWebTestCase
{

    const USER_LOGIN = 'user1';

    public function loadEntryPoints()
    {
        return [
            // ADMIN PART
            'testAuthenticate' => [
                [
                    'type' => 'GET',
                    'url' => '/login',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                    'additionalCheck' => [
                        'login',
                        'badLogin',
                    ],
                ],
            ],
            'testLogout' => [
                [
                    'type' => 'GET',
                    'url' => '/logout',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
        ];
    }

    public function login(array $params)
    {
        $client = clone $params['client'];
        $client->submitForm('login_submit', [
            'username' => 'admin1',
            'password' => 'admin1',
        ]);
        assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }

    public function badLogin(array $params)
    {
        $client = clone $params['client'];
        $client->submitForm('login_submit', [
            'username' => 'admin1',
            'password' => 'admin2',
        ]);
        assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
