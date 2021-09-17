<?php


namespace App\Tests\Manager;


use App\Entity\User;
use App\Manager\UserManager;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class UserManagerTest extends TestCase
{
    protected $userManager;

    public function test__construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function testSetPassword(){
        $user = new User();
        $plainPassword = "toto";
        $encodedPassword = '$2y$10$wkUNVUD7B575rsx7AwAWseV5P/HRwkgoc5cvNC/WppJvbwXGOySAe';
        $this->userManager->setPassword($user, $plainPassword);
        assertEquals($encodedPassword, $user->getPassword());
    }
}