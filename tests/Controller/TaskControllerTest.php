<?php

namespace App\Tests\Controller;

use App\Tests\XwykWebTestCase;

abstract class TaskControllerTest extends XwykWebTestCase
{
    // admin username
    public const ADMIN_LOGIN = 'admin1';
    // task id belong to admin
    public const ADMIN_TASK_ID = 250;
    // task id that exists, but doesn't belong to admin and isn't anonymous
    public const ADMIN_BAD_TASK_ID = 2;
    // admin tasks number
    public const ADMIN_TASKS = 100;

    // user username
    public const USER_LOGIN = 'user1';
    // task id belong to user
    public const USER_TASK_ID = 1;
    // task id that exists, but doesn't belong to user
    public const USER_BAD_TASK_ID = 200;
    // user tasks number
    public const USER_TASKS = 100;

    // task id that doesn't exist
    public const DEFAULT_FAKE_TASK_ID = 100000;
    // anonymous tasks number
    public const ANONYMOUS_TASKS = 100;
    // task id that is anonymous (author id is null)
    public const ANONYMOUS_TASK_ID = 450;
}
