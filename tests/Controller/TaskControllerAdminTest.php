<?php

namespace App\Tests\Controller;

use function PHPUnit\Framework\assertEquals;
use Symfony\Component\HttpFoundation\Response;

class TaskControllerAdminTest extends TaskControllerTest
{
    public function loadEntryPoints(): array
    {
        return [
            // ADMIN PART
            'testTaskListGetAdm' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                    'additionalCheck' => [
                        'checkTaskNumber',
                    ],
                ],
            ],
            'testTaskCreateGetAdm' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/create',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                    'additionalCheck' => [
                        'createPostDataOk',
                        'createPostDataKo',
                    ],
                ],
            ],
            'testTaskCreatePostAdm' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/create',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                ],
            ],
            'testTaskEditGetAdmIdOk' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/'.self::ADMIN_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                    'additionalCheck' => [
                        'editPostDataOk',
                        'editPostDataKo',
                    ],
                ],
            ],
            'testTaskEditGetAdmIdNotValid' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskEditGetAdmIdNotBelong' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/'.self::ADMIN_BAD_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskEditGetAdmAnonymousTask' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                    'additionalCheck' => [
                        'editPostDataOk',
                        'editPostDataKo',
                    ],
                ],
            ],
            'testTaskEditGetAdmIdNotValidDataOk' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskEditGetAdmIdNotValidDataKo' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskEditGetAdmIdNotBelongDataOk' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::USER_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskEditGetAdmIdNotBelongDataKo' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::USER_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskTogglePutAdmIdOk' => [
                [
                    'type' => 'PUT',
                    'url' => '/tasks/'.self::ADMIN_TASK_ID.'/toggle',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                ],
            ],
            'testTaskTogglePutAdmIdNotValid' => [
                [
                    'type' => 'PUT',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/toggle',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskTogglePutAdmIdNotBelong' => [
                [
                    'type' => 'PUT',
                    'url' => '/tasks/'.self::USER_TASK_ID.'/toggle',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskTogglePutAdmAnonymousTask' => [
                [
                    'type' => 'PUT',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/toggle',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_OK,
                ],
            ],
            'testTaskDeleteDeleteAdmIdOk' => [
                [
                    'type' => 'DELETE',
                    'url' => '/tasks/'.self::ADMIN_TASK_ID.'/delete',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NO_CONTENT,
                ],
            ],
            'testTaskDeleteDeleteAdmIdNotValid' => [
                [
                    'type' => 'DELETE',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/delete',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskDeleteDeleteAdmIdNotBelong' => [
                [
                    'type' => 'DELETE',
                    'url' => '/tasks/'.self::USER_TASK_ID.'/delete',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_FORBIDDEN,
                ],
            ],
            'testTaskDeleteDeleteAdmAnonymousTask' => [
                [
                    'type' => 'DELETE',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/delete',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => 'ADMIN',
                    'content' => '',
                    'expectedCode' => Response::HTTP_NO_CONTENT,
                ],
            ],
        ];
    }

    public function checkRedirectionShowTasksNotLogged(array $params)
    {
        $crawler = $params['crawler'];
        $crawler
            ->filter('body')
            ->reduce(function ($node, $i) {
                assertEquals('Redirecting to /login.', $node->text());
            })
            ->first()
        ;
    }

    public function checkUserTasksShowTasksAsUser(array $params)
    {
        $crawler = $params['crawler'];
        // Check tasks number
        assertEquals(self::USER_TASKS, $crawler->filter('.task')->count());
//        $crawler
//            ->filter('.task')
//            ->reduce(function ($node, $i) {
//                dump($node);
//            })
//            ->first()
//        ;
    }

    public function checkAnonymousTasksShow(array $params)
    {
    }

    public function checkTaskNumber(array $params)
    {
        $crawler = $params['crawler'];
        assertEquals(self::ADMIN_TASKS + self::ANONYMOUS_TASKS, $crawler->filter('.task')->count());
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
