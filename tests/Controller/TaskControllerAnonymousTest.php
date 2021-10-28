<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;

class TaskControllerAnonymousTest extends TaskControllerTest
{
    public function loadEntryPoints(): array
    {
        return [
            'testTaskListGetAno' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testTaskCreateGetAno' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/create',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testTaskCreatePostAnoDataOK' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/create',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testTaskCreatePostAnoDataKO' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/create',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testTaskEditGetAnoIdOk' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testTaskEditGetAnoIdNotValid' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskEditGetAnoAnonymousTask' => [
                [
                    'type' => 'GET',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testTaskEditPostAnoIdOkDataOk' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testTaskEditPostAnoIdOkDataKo' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testTaskEditGetAnoIdNotValidDataOk' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskEditGetAnoIdNotValidDataKo' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskEditGetAnoAnonymousTaskDataOk' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testTaskEditGetAnoAnonymousTaskDataKo' => [
                [
                    'type' => 'POST',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/edit',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testTaskTogglePutAnoIdOk' => [
                [
                    'type' => 'PUT',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/toggle',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testTaskTogglePutAnoIdNotValid' => [
                [
                    'type' => 'PUT',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/toggle',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskTogglePutAnonymousTask' => [
                [
                    'type' => 'PUT',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/toggle',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testTaskDeleteDeleteAnoIdOk' => [
                [
                    'type' => 'DELETE',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/delete',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
            'testTaskDeleteDeleteAnoIdNotValid' => [
                [
                    'type' => 'DELETE',
                    'url' => '/tasks/'.self::DEFAULT_FAKE_TASK_ID.'/delete',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_NOT_FOUND,
                ],
            ],
            'testTaskDeleteDeleteAnoAnonymousTask' => [
                [
                    'type' => 'DELETE',
                    'url' => '/tasks/'.self::ANONYMOUS_TASK_ID.'/delete',
                    'parameters' => [],
                    'files' => [],
                    'server' => [],
                    'authenticated' => null,
                    'content' => '',
                    'expectedCode' => Response::HTTP_FOUND,
                ],
            ],
        ];
    }
}
