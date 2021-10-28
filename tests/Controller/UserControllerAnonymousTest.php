<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\assertEquals;

class UserControllerAnonymousTest extends UserControllerTest
{
    public function loadEntryPoints(): array
    {
        return [
            'testUserListGetAno' => [
                [
                    'type' => 'GET',
                    'url' => '/users',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testUserCreateGetAno' => [
                [
                    'type' => 'GET',
                    'url' => '/users/create',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                    'additionalCheck' => [
                        'createDataOk',
                        'createDataKo',
                    ],
                ],
            ],
            'testUserEditGetAnoIdOk' => [
                [
                    'type' => 'GET',
                    'url' => '/users/'.self::USER_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testUserEditGetAnoIdNotValid' => [
                [
                    'type' => 'GET',
                    'url' => '/users/'.self::USER_WRONG_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testUserEditGetAnoIdNotValidDataOk' => [
                [
                    'type' => 'POST',
                    'url' => '/users/'.self::USER_WRONG_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testUserEditGetAnoIdNotValidDataKo' => [
                [
                    'type' => 'POST',
                    'url' => '/users/'.self::USER_WRONG_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
        ];
    }

    public function createDataOk(array $params)
    {
        $client = clone $params['client'];

        $client->submitForm('user_create_submit', [
            'user[username]' => 'usertest',
            'user[password][first]' => 'usertest',
            'user[password][second]' => 'usertest',
            'user[email]' => 'usertest@todoco.fr',
        ]);
        assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }

    public function createDataKo(array $params)
    {
        $client = clone $params['client'];
        $client->submitForm('user_create_submit', [
            'user[username]' => null,
            'user[password][first]' => 'usertest',
            'user[password][second]' => 'usertest',
            'user[email]' => 'usertest@todoco.fr',
        ]);
        assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}
