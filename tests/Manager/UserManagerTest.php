<?php


namespace App\Tests\Manager;


use App\Entity\User;
use App\Manager\UserManager;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class UserManagerTest extends KernelTestCase
{
    protected $userManager;
    protected $passwordHasher;

    /**
     * Boot Kernel and get UserManager instance before testing
     */
    protected function setUp(): void
    {
        self::bootKernel();
        $this->userManager = static::getContainer()->get(UserManager::class);
        $this->passwordHasher = static::getContainer()->get(UserPasswordHasherInterface::class);
    }

    public function testSetPassword(){
        $user = new User();
        $plainPassword = "toto";
        $this->userManager->setPassword($user, $plainPassword);
        assertTrue($this->passwordHasher->isPasswordValid($user, "toto"));
    }
}