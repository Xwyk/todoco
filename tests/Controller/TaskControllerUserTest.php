<?php

namespace App\Tests\Controller;

use function PHPUnit\Framework\assertEquals;
use Symfony\Component\HttpFoundation\Response;

class TaskControllerUserTest extends TaskControllerTest
{
    public function loadEntryPoints(): array
    {
        return [
            'testTaskListGetUsr' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                ],
            ],
            'testTaskCreateGetUsr' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/create',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                    'additionalCheck' => [
                        'createPostDataOk',
                        'createPostDataKo',
                    ],
                ],
            ],
            'testTaskEditGetUsrIdOk' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/'.self::USER_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                    'additionalCheck' => [
                        'editPostDataOk',
                        'editPostDataKo',
                    ],
                ],
            ],
            'testTaskEditGetUsrIdNotValid' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,

                ],
            ],
            'testTaskEditGetUsrIdNotBelong' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/'.self::USER_BAD_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskEditGetUsrAnonymousTask' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskEditGetUsrIdNotValidDataOk' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskEditGetUsrIdNotValidDataKo' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskEditGetUsrIdNotBelongDataOk' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::USER_BAD_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskEditGetUsrIdNotBelongDataKo' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::USER_BAD_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskEditGetUsrAnonymousTaskDataOk' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskEditGetUsrAnonymousTaskDataKo' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskTogglePutUsrIdOk' => [
                [
                    'type' => 'PUT',
                    'url' => '/tasks/'.self::USER_TASK_ID.'/toggle',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                ],
            ],
            'testTaskTogglePutUsrIdNotValid' => [
                [
                    'type' => 'PUT',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/toggle',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskTogglePutUsrIdNotBelong' => [
                [
                    'type' => 'PUT',
                    'url' => '/tasks/'.self::USER_BAD_TASK_ID.'/toggle',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskTogglePutUsrAnonymousTask' => [
                [
                    'type' => 'PUT',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/toggle',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskDeleteDeleteUsrIdOk' => [
                [
                    'type' => 'DELETE',
                    'url' => '/tasks/'.self::USER_TASK_ID.'/delete',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NO_CONTENT,
                ],
            ],
            'testTaskDeleteDeleteUsrIdNotValid' => [
                [
                    'type' => 'DELETE',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/delete',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskDeleteDeleteUsrIdNotBelong' => [
                [
                    'type' => 'DELETE',
                    'url' => '/tasks/'.self::USER_BAD_TASK_ID.'/delete',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'USER',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskDeleteDeleteUsrAnonymousTask' => [
                [
                    'type' => 'DELETE',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/delete',
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

    public function createPostDataOk(array $params)
    {
        $client = clone $params['client'];

        $client->submitForm('task_create_submit', [
            'task[title]' => '...',
            'task[content]' => '...',
        ]);
        assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }

    public function createPostDataKo(array $params)
    {
        $crawler = clone $params['crawler'];
        $client = clone $params['client'];
        $client->submitForm('task_create_submit', [
            'task[title]' => null,
            'task[content]' => null,
        ]);
        assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function editPostDataOk(array $params)
    {
        $client = clone $params['client'];

        $client->submitForm('task_edit_submit', [
            'task[title]' => '...',
            'task[content]' => '...',
        ]);
        assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }

    public function editPostDataKo(array $params)
    {
        $crawler = clone $params['crawler'];
        $client = clone $params['client'];
        $client->submitForm('task_edit_submit', [
            'task[title]' => null,
            'task[content]' => null,
        ]);
        assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $client->getResponse()->getStatusCode());
    }
}
