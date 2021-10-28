<?php

namespace App\Tests\Controller;

use function PHPUnit\Framework\assertEquals;
use Symfony\Component\HttpFoundation\Response;

class UserControllerAdminTest extends UserControllerTest
{
    public function loadEntryPoints()
    {
        return [
            'testUserListGetAdm' => [
                [
                    'type' => 'GET',
                    'url' => '/users',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                ],
            ],
            'testUserCreateGetAdm' => [
                [
                    'type' => 'GET',
                    'url' => '/users/create',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                    'additionalCheck' => [
                        'createDataOk',
                        'createDataKo',
                    ],
                ],
            ],
            'testUserEditGetAdmIdOk' => [
                [
                    'type' => 'GET',
                    'url' => '/users/'.self::USER_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                    'additionalCheck' => [
                        'editDataOk',
                        'editDataKo',
                    ],
                ],
            ],
            'testUserEditGetAdmIdNotValid' => [
                [
                    'type' => 'GET',
                    'url' => '/users/'.self::USER_WRONG_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testUserEditGetAdmIdNotBelong' => [
                [
                    'type' => 'GET',
                    'url' => '/users/'.self::USER_BAD_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                ],
            ],
            'testUserEditGetAdmIdNotValidDataOk' => [
                [
                    'type' => 'POST',
                    'url' => '/users/'.self::USER_WRONG_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testUserEditGetAdmIdNotValidDataKo' => [
                [
                    'type' => 'POST',
                    'url' => '/users/'.self::USER_WRONG_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testUserEditGetAdmIdNotBelongDataOk' => [
                [
                    'type' => 'POST',
                    'url' => '/users/'.self::USER_BAD_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                ],
            ],
            'testUserEditGetAdmIdNotBelongDataKo' => [
                [
                    'type' => 'POST',
                    'url' => '/users/'.self::USER_BAD_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
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
            'user[role]' => 'ROLE_USER',
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
            'user[role]' => 'ROLE_USER',
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
            'user[role]' => 'ROLE_USER',
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
            'user[role]' => 'ROLE_USER',
        ]);
        assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
