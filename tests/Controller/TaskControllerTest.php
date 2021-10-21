<?php

namespace App\Tests\Controller;

use App\Tests\XwykWebTestCase;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

abstract class TaskControllerTest extends XwykWebTestCase
{
    // admin username
    const ADMIN_LOGIN = "admin1";
    // task id belong to admin
    const ADMIN_TASK_ID = 250;
    // task id that exists, but doesn't belong to admin and isn't anonymous
    const ADMIN_BAD_TASK_ID = 2;
    // admin tasks number
    const ADMIN_TASKS = 100;

    // user username
    const USER_LOGIN = "user1";
    // task id belong to user
    const USER_TASK_ID = 1;
    // task id that exists, but doesn't belong to user
    const USER_BAD_TASK_ID = 200;
    // user tasks number
    const USER_TASKS = 100;

    // task id that doesn't exist
    const DEFAULT_FAKE_TASK_ID = 100000;
    // anonymous tasks number
    const ANONYMOUS_TASKS = 100;
    // task id that is anonymous (author id is null)
    const ANONYMOUS_TASK_ID = 450;
}