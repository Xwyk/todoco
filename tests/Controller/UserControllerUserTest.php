<?php

namespace App\Tests\Controller;

use function PHPUnit\Framework\assertEquals;
use Symfony\Component\HttpFoundation\Response;

class UserControllerUserTest extends UserControllerTest
{
    public function loadEntryPoints()
    {
        return [
            'testUserListGetUsr' => [
                [
                    'type' => 'GET',
                    'url' => '/users',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testUserCreateGetUsr' => [
                [
                    'type' => 'GET',
                    'url' => '/users/create',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                    'additionalCheck' => [
                        'createDataOk',
                        'createDataKo',
                    ],
                ],
            ],
            'testUserEditGetUsrIdOk' => [
                [
                    'type' => 'GET',
                    'url' => '/users/'.self::USER_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                    'additionalCheck' => [
                        'editDataOk',
                        'editDataKo',
                    ],
                ],
            ],
            'testUserEditGetUsrIdNotValid' => [
                [
                    'type' => 'GET',
                    'url' => '/users/'.self::USER_WRONG_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testUserEditGetUsrIdNotBelong' => [
                [
                    'type' => 'GET',
                    'url' => '/users/'.self::USER_BAD_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testUserEditGetUsrIdNotValidDataOk' => [
                [
                    'type' => 'POST',
                    'url' => '/users/'.self::USER_WRONG_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testUserEditGetUsrIdNotValidDataKo' => [
                [
                    'type' => 'POST',
                    'url' => '/users/'.self::USER_WRONG_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testUserEditGetUsrIdNotBelongDataOk' => [
                [
                    'type' => 'POST',
                    'url' => '/users/'.self::USER_BAD_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testUserEditGetUsrIdNotBelongDataKo' => [
                [
                    'type' => 'POST',
                    'url' => '/users/'.self::USER_BAD_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
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

    public function editDataOk(array $params)
    {
        $client = clone $params['client'];

        $client->submitForm('user_edit_submit', [
            'user[username]' => 'usertest',
            'user[password][first]' => 'usertest',
            'user[password][second]' => 'usertest',
            'user[email]' => 'usertest@todoco.fr',
        ]);
        assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }

    public function editDataKo(array $params)
    {
        $client = clone $params['client'];
        $client->submitForm('user_edit_submit', [
            'user[username]' => 'null',
            'user[password][first]' => 'usertest',
            'user[password][second]' => 'usertest',
            'user[email]' => 'usertest@todoco.fr',
        ]);
        assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
