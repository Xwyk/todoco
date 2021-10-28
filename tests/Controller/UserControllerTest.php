<?php

namespace App\Tests\Controller;

use App\Tests\XwykWebTestCase;

abstract class UserControllerTest extends XwykWebTestCase
{
    // admin username
    public const ADMIN_LOGIN = 'admin1';

    // user username
    public const USER_LOGIN = 'user1';
    // user id
    public const USER_ID = 1;
    // user id that exists, but doesn't belong to user
    public const USER_BAD_ID = 2;
    // user id that doesn't exist
    public const USER_WRONG_ID = 10;
}